@extends('layouts.admin')

@section('title', 'Produtos Admin')

@section('content')
<div class="container">
    <h1>Cadastrar Novo Jogo</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produtos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descrição:</label>
            <textarea name="descricao" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Quantidade em Estoque:</label>
            <input type="number" name="quantidade_estoque" class="form-control" required min="0">
        </div>

        <div class="mb-3">
            <label>Valor:</label>
            <input type="text" name="valor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Categoria:</label>
            <select name="categoria_id" class="form-select" required>
                <option value="">Selecione</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Plataforma:</label>
            <select name="plataforma_id" class="form-select" required>
                <option value="">Selecione</option>
                @foreach($plataformas as $plataforma)
                    <option value="{{ $plataforma->id }}">{{ $plataforma->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Capa do Jogo:</label>
            <input type="file" name="capa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Imagens de Gameplay:</label>
            <input type="file" name="imagens[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Jogo</button>
    </form>
</div>
@endsection
