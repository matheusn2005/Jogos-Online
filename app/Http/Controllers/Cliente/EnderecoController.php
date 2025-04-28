<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Endereco;

class EnderecoController extends Controller
{
    public function index()
    {
        $enderecos = Auth::user()->enderecos ?? [];
        return view('cliente.enderecos.index', compact('enderecos'));
    }

    public function create()
    {
        return view('cliente.enderecos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:50',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
        ]);

        Endereco::create([
            'cliente_id' => Auth::id(),
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
        ]);

        return redirect()->route('cliente.enderecos.index')->with('success', 'Endereço cadastrado com sucesso!');
    }

    public function edit(Endereco $endereco)
    {
        if ($endereco->cliente_id !== Auth::id()) {
            abort(403);
        }

        return view('cliente.enderecos.edit', compact('endereco'));
    }

    public function update(Request $request, Endereco $endereco)
    {
        if ($endereco->cliente_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:50',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
        ]);

        $endereco->update([
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
        ]);

        return redirect()->route('cliente.enderecos.index')->with('success', 'Endereço atualizado com sucesso!');
    }

    public function destroy(Endereco $endereco)
    {
        if ($endereco->cliente_id !== Auth::id()) {
            abort(403);
        }

        $endereco->delete();

        return redirect()->route('cliente.enderecos.index')->with('success', 'Endereço removido com sucesso!');
    }
}
