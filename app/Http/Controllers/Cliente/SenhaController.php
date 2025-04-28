<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SenhaController extends Controller
{
    public function edit()
    {
        return view('cliente.senha.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'senha_atual' => ['required'],
            'nova_senha' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!Hash::check($request->senha_atual, Auth::user()->password)) {
            return back()->withErrors(['senha_atual' => 'A senha atual não confere.']);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->nova_senha);
        $user->save();

        return redirect()->route('cliente.dashboard')->with('success', 'Senha alterada com sucesso!');
    }
}
