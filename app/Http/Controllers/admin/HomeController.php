<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Produto;

class HomeController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('site.home', compact('produtos'));
    }

    public function show($slug)
    {
        $produto = Produto::where('slug', $slug)->firstOrFail();
        return view('site.produto', compact('produto'));
    }
}
