<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Str;
use App\Models\ImagemProduto;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.produtos.create', compact('categorias'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string',
        'quantidade_estoque' => 'required|integer|min:0',
        'valor' => 'required|numeric|min:0',
        'capa' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'imagens.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Upload da capa
    $caminhoCapa = $request->file('capa')->store('capas', 'public');

    // Cria o produto (jogo)
    $produto = Produto::create([
        'nome' => $request->nome,
        'descricao' => $request->descricao,
        'quantidade_estoque' => $request->quantidade_estoque,
        'slug' => \Illuminate\Support\Str::slug($request->nome),
        'valor' => $request->valor,
        'categoria_id' => $request->categoria_id,
        'capa' => $caminhoCapa,
    ]);

    // Upload das imagens de gameplay
    if ($request->hasFile('imagens')) {
        foreach ($request->file('imagens') as $imagem) {
            $caminhoImagem = $imagem->store('imagens', 'public');

            ImagemProduto::create([
                'produto_id' => $produto->id,
                'imagem' => $caminhoImagem,
            ]);
        }
    }

    return redirect()->route('admin.dashboard')->with('success', 'Jogo cadastrado com sucesso!');
}
}
