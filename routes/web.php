<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cliente\DashboardController as ClienteDashboardController;
use App\Http\Controllers\Cliente\LojaController;
use App\Http\Controllers\Cliente\CarrinhoController;
use App\Http\Controllers\Cliente\SenhaController;
use App\Http\Controllers\Cliente\EnderecoController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\PlataformaController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/jogos', [LojaController::class, 'index'])->name('loja.index');
Route::get('/jogos/{slug}', [LojaController::class, 'show'])->name('loja.show');


Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::get('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
Route::get('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
Route::get('/carrinho/checkout', [CarrinhoController::class, 'checkout'])->name('carrinho.checkout');
Route::post('/carrinho/finalizar', [CarrinhoController::class, 'finalizarCompra'])->name('carrinho.finalizar');

Route::prefix('cliente')->name('cliente.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [ClienteDashboardController::class, 'index'])->name('dashboard');

    Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
    Route::get('/carrinho/adicionar/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::get('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
    Route::get('/carrinho/checkout', [CarrinhoController::class, 'checkout'])->name('carrinho.checkout');
    Route::post('/carrinho/finalizar', [CarrinhoController::class, 'finalizarCompra'])->name('carrinho.finalizar');

    Route::get('/senha/edit', [SenhaController::class, 'edit'])->name('senha.edit');
    Route::post('/senha/update', [SenhaController::class, 'update'])->name('senha.update');

    Route::resource('enderecos', EnderecoController::class)->except(['show']);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/password/edit', [ProfileController::class, 'edit'])->name('password.edit');
        Route::post('/password/update', [ProfileController::class, 'update'])->name('password.update');

        Route::get('/register', [AdminRegisterController::class, 'create'])->name('register');
        Route::post('/register', [AdminRegisterController::class, 'store']);

        Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
        Route::post('/produtos/store', [ProdutoController::class, 'store'])->name('produtos.store');

        Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
        Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.store');

        Route::get('/plataformas/create', [PlataformaController::class, 'create'])->name('plataformas.create');
        Route::post('/plataformas/store', [PlataformaController::class, 'store'])->name('plataformas.store');
    });
});
