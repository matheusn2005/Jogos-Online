<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function compras()
    {
        $compras = auth()->user()->vendas()->latest()->get();
        return view('cliente.compras', compact('compras'));
    }

}
