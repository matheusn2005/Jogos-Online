<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiConfig;

class ApiConfigController extends Controller
{
    public function index()
    {
        $config = ApiConfig::first();
        return view('admin.api-config', compact('config'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cacapay_url' => 'required|url',
            'cacapay_token' => 'required|string',
            'cacalog_url' => 'required|url',
            'cacalog_token' => 'required|string',
        ]);

        $config = ApiConfig::firstOrNew(['id' => 1]);
        $config->fill($request->all())->save();

        return redirect()->route('admin.api-config.index')->with('success', 'Configurações salvas com sucesso!');
    }
}

