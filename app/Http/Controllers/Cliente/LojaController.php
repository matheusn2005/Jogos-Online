<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\ImagemProduto;

class LojaController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('cliente.loja.index', compact('produtos'));
    }
    public function show($slug)
    {
        $produto = Produto::where('slug', $slug)->firstOrFail();
        $imagens = $produto->imagens; // pegar imagens relacionadas

        return view('cliente.loja.show', compact('produto', 'imagens'));
    }
}
