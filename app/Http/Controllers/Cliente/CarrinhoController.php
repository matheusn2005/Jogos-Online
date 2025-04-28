<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use App\Models\Endereco; // Importar o model de endereços
use App\Models\Venda;
use App\Models\ProdutoVenda;


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
        $carrinho = session()->get('carrinho', []);

        if (count($carrinho) == 0) {
            return redirect()->route('cliente.carrinho.index')->with('error', 'Carrinho vazio!');
        }

        $request->validate([
            'endereco_id' => ['required', 'exists:enderecos,id'],
        ]);

        
        $venda = Venda::create([
            'cliente_id' => Auth::id(),
            'endereco_id' => $request->endereco_id,
            'valor_total' => collect($carrinho)->sum(function ($item) {
                return $item['preco'] * $item['quantidade'];
            }),
        ]);

        
        foreach ($carrinho as $id => $item) {
            ProdutoVenda::create([
                'venda_id' => $venda->id,
                'produto_id' => $id,
                'quantidade' => $item['quantidade'],
                'subtotal' => $item['preco'] * $item['quantidade'],
            ]);
        }

        
        session()->forget('carrinho');

        return redirect()->route('loja.index')->with('success', 'Compra realizada com sucesso!');
    }
}
