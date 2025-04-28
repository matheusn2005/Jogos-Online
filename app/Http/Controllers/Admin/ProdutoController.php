<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Str;
use App\Models\ImagemProduto;
use App\Models\Categoria;
use App\Models\Plataforma;

class ProdutoController extends Controller
{
    public function create()
    {
        $categorias = Categoria::all();
        $plataformas = Plataforma::all();
        return view('admin.produtos.create', compact('categorias', 'plataformas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'quantidade_estoque' => 'required|integer|min:0',
            'valor' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'plataforma_id' => 'required|exists:plataformas,id',
            'capa' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'imagens.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

      
        $caminhoCapa = $request->file('capa')->store('capas', 'public');

        
        $produto = Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'quantidade_estoque' => $request->quantidade_estoque,
            'slug' => Str::slug($request->nome),
            'valor' => $request->valor,
            'categoria_id' => $request->categoria_id,
            'plataforma_id' => $request->plataforma_id, 
            'capa' => $caminhoCapa,
        ]);

        
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
