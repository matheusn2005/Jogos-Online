<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use App\Models\Endereco; // Importar o model de endereços
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

        // Se o produto já estiver no carrinho, incrementa quantidade
        if (isset($carrinho[$id])) {
            $carrinho[$id]['quantidade']++;
        } else {
            // Se não, adiciona
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

        // 🔐 Dados da API
        $config = ApiConfig::first();
        $cpf = $user->cpf; // supondo que tenha esse campo

        // ✅ Chamada para a Caçapay
        $resposta = Http::withToken($config->cacapay_token)
            ->post($config->cacapay_url, ['cpf' => $cpf]);

        if ($resposta->failed() || $resposta->json('status') == 'negado') {
            $venda->status = 'negado';
            $venda->save();
            return redirect()->back()->with('error', 'Compra não autorizada pela Caçapay.');
        }

        // ✅ Pagamento aprovado
        $venda->status = 'pago';
        $venda->save();

        // 📦 Envio para Caçalog
        $entrega = Http::withToken($config->cacalog_token)
            ->post($config->cacalog_url, [
                'venda_id' => $venda->id,
                'cliente' => $user->name,
                'endereco' => $user->enderecos->first()?->toArray() ?? [],
            ]);

        return redirect()->route('cliente.dashboard')->with('success', 'Compra finalizada com sucesso!');
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
