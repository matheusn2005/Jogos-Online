<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plataforma;

class PlataformaController extends Controller
{
    public function create()
    {
        return view('admin.plataformas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Plataforma::create($request->only('nome'));

        return redirect()->route('admin.plataformas.create')->with('success', 'Plataforma cadastrada com sucesso!');
    }
}
