@extends('layouts.admin')

@section('title', 'Plataformas')

@section('content')
<div class="container">
    <h1>Cadastrar Plataforma</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.plataformas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome da Plataforma:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
