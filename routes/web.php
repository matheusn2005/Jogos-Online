<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('cliente.home'); });
Route::get('/produtos', function () { return view('cliente.produtos'); });
Route::get('/produto/{id}', function ($id) { return view('cliente.produto_detalhe'); });
Route::get('/carrinho', function () { return view('cliente.carrinho'); });
Route::get('/checkout', function () { return view('cliente.checkout'); });
Route::get('/login', function () { return view('cliente.login'); });
Route::get('/cadastro', function () { return view('cliente.cadastro'); });

Route::prefix('admin')->group(function() {
    Route::get('/', function() { return view('admin.dashboard'); });
    Route::get('/produtos', function() { return view('admin.produtos'); });
    Route::get('/categorias', function() { return view('admin.categorias'); });
    Route::get('/plataformas', function() { return view('admin.plataformas'); });
});