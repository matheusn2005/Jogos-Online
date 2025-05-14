<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;

class EntregaController extends Controller
{
    // 🛠️ Acesso pelo ADMIN - Lista todas as entregas de compras pagas
    public function index()
    {
        $compras = Compra::where('status_pagamento', 'pago')->get();
        return view('admin.entregas.index', compact('compras'));
    }

    // 👤 Acesso pelo CLIENTE - Lista apenas as compras pagas do próprio cliente
    public function minhasEntregas()
    {
        $compras = Compra::where('user_id', auth()->id())
                         ->where('status_pagamento', 'pago')
                         ->get();
        return view('cliente.entregas', compact('compras'));
    }

    // Atualização do status de entrega (Admin)
    public function atualizar(Request $request, Compra $compra)
    {
        $request->validate([
            'status_entrega' => 'required|in:pendente,a_caminho,entregue',
        ]);

        $compra->status_entrega = $request->status_entrega;
        $compra->save();

        return redirect()->back()->with('success', 'Status de entrega atualizado com sucesso.');
    }
}
