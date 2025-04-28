@extends('layouts.app')

@section('content')
<div class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4">Dashboard do Administrador</h1>

    <div class="d-flex flex-wrap gap-3">

        <a href="{{ route('admin.produtos.create') }}" class="btn btn-primary btn-lg">
            Cadastrar Novo Jogo
        </a>

        <a href="{{ route('admin.categorias.create') }}" class="btn btn-secondary btn-lg">
            Cadastrar Nova Categoria
        </a>

        <a href="{{ route('admin.plataformas.create') }}" class="btn btn-success btn-lg">
            Cadastrar Nova Plataforma
        </a>

        <a href="{{ route('admin.register') }}" class="btn btn-warning btn-lg">
            Cadastrar Novo Usuário Admin
        </a>

        <a href="{{ route('admin.password.edit') }}" class="btn btn-dark btn-lg">
            Alterar Minha Senha
        </a>

    </div>

</div>
@endsection
