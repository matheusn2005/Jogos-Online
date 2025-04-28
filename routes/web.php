<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cliente\DashboardController as ClienteDashboardController;
use App\Http\Controllers\Cliente\LojaController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\CategoriaController;

// Rotas para administradores
Route::prefix('admin')->name('admin.')->group(function () {
    // Login de Admin
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Rotas protegidas para Admin
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Alterar senha de Admin
        Route::get('/password/edit', [ProfileController::class, 'edit'])->name('password.edit');
        Route::post('/password/update', [ProfileController::class, 'update'])->name('password.update');

        // Cadastro de novo administrador
        Route::get('/register', [AdminRegisterController::class, 'create'])->name('register');
        Route::post('/register', [AdminRegisterController::class, 'store']);

        // Cadastro de novos produtos (jogos)
        Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
        Route::post('/produtos/store', [ProdutoController::class, 'store'])->name('produtos.store');

        // Cadastro de categorias de jogos
        Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
        Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.store');
    });
});

// Rotas para clientes (área logada)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ClienteDashboardController::class, 'index'])->name('dashboard');
});

// Autenticação de Clientes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Cadastro de Clientes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Loja (para todos clientes visualizarem)
Route::get('/jogos', [LojaController::class, 'index'])->name('loja.index');
Route::get('/jogos/{slug}', [LojaController::class, 'show'])->name('loja.show');

// Página inicial
Route::get('/', function () {
    return view('welcome');
});
