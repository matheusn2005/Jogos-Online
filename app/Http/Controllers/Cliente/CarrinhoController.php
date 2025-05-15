<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use App\Models\Endereco;
use App\Models\Venda;
use App\Models\ProdutoVenda;
use App\Models\ApiConfig;
use Illuminate\Support\Facades\Http;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);
        return view('cliente.carrinho.index', compact('carrinho'));
    }

    public function adicionar($id)
    {
        $produto = Produto::findOrFail($id);
        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            $carrinho[$id]['quantidade']++;
        } else {
            $carrinho[$id] = [
                "nome" => $produto->nome,
                "preco" => $produto->valor,
                "quantidade" => 1,
                "capa" => $produto->capa,
            ];
        }

        session()->put('carrinho', $carrinho);
        return redirect()->route('loja.index')->with('success', 'Jogo adicionado ao carrinho!');
    }

    public function remover($id)
    {
        $carrinho = session()->get('carrinho', []);
        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }
        return redirect()->route('carrinho.index')->with('success', 'Jogo removido do carrinho!');
    }

    public function checkout()
    {
        $carrinho = session()->get('carrinho', []);
        if (count($carrinho) == 0) {
            return redirect()->route('cliente.carrinho.index')->with('error', 'Seu carrinho está vazio!');
        }

        $enderecos = Auth::user()->enderecos ?? [];
        return view('cliente.carrinho.checkout', compact('carrinho', 'enderecos'));
    }

    public function finalizarCompra(Request $request)
    {
        $user = auth()->user();

        $venda = new Venda([
            'cliente_id' => $user->id,
            'endereco_id' => $request->endereco_id,
            'valor_total' => $this->calcularTotalCarrinho(),
            'status' => 'pendente'
        ]);
        $venda->save();

        $config = ApiConfig::first();
        if (!$config) {
            return redirect()->back()->with('error', 'Configuração da API não encontrada.');
        }

        $cpf = preg_replace('/[^0-9]/', '', $user->cpf);

        // Envio para Caçapay
        $resposta = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->withToken($config->cacapay_token)
            ->post(rtrim($config->cacapay_url, '/'), [
                'partner_company_id' => '13df86bb-c0fd-4a94-ba51-244e117efb99',
                'name' => $user->name,
                'cpf' => $cpf,
                'amount' => $venda->valor_total,
            ]);

        $statusCode = $resposta->status();

        if (in_array($statusCode, [200, 201])) {
            $venda->status = 'pago';
            $venda->save();

            // Envio para Caçalog
            $endereco = $user->enderecos->first();

            if (!$endereco) {
                return redirect()->back()->with('error', 'Endereço do cliente não encontrado.');
            }

            $carrinho = session()->get('carrinho', []);
            $conteudoEntrega = implode(', ', array_map(fn($item) => $item['nome'], $carrinho));

            Http::withOptions(['verify' => false])
                ->withToken($config->cacalog_token)
                ->post(rtrim($config->cacalog_url, '/') . '/api/entregas', [
                    'cliente' => $user->name,
                    'cep' => '89504590',
                    'rua' => $endereco->rua,
                    'bairro' => $endereco->bairro,
                    'conteudo_entrega' => $conteudoEntrega,
                    'codigo_pedido' => $venda->id,
                ]);

            session()->forget('carrinho');
            return redirect()->route('cliente.dashboard')->with('success', 'Compra finalizada com sucesso!');
        }

        // Tratamento de erros
        switch ($statusCode) {
            case 400:
                $mensagem = 'Falha no pagamento, saldo insuficiente.';
                break;
            case 401:
                $mensagem = 'Token de autenticação inválido ou ausente.';
                break;
            case 422:
                $mensagem = 'CPF inválido ou saldo insuficiente.';
                break;
            case 404:
                $mensagem = 'Empresa parceira não encontrada.';
                break;
            case 500:
            default:
                $mensagem = 'Erro interno na Caçapay. Tente novamente em instantes.';
                break;
        }

        $venda->status = 'negado';
        $venda->save();

        return redirect()->back()->with('error', $mensagem);
    }

    private function calcularTotalCarrinho()
    {
        $carrinho = session()->get('carrinho', []);
        $total = 0;

        foreach ($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        return $total;
    }
}
