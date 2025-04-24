<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session()->get('carrinho', []);
        return view('site.carrinho', compact('carrinho'));
    }

    public function adicionar($id)
    {
        $produto = Produto::findOrFail($id);
        $carrinho = session()->get('carrinho', []);

        if(isset($carrinho[$id])){
            $carrinho[$id]['quantidade']++;
        } else {
            $carrinho[$id] = [
                "nome" => $produto->nome,
                "quantidade" => 1,
                "preco" => $produto->valor,
            ];
        }

        session()->put('carrinho', $carrinho);

        return redirect()->route('site.carrinho')->with('success', 'Produto adicionado!');
    }

    public function remover($id)
    {
        $carrinho = session()->get('carrinho', []);
        if(isset($carrinho[$id])){
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }
        return redirect()->route('site.carrinho')->with('success', 'Produto removido!');
    }

    public function finalizar()
    {
        session()->forget('carrinho');
        return redirect()->route('site.home')->with('success', 'Compra finalizada com sucesso!');
    }
}
