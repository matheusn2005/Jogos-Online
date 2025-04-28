@extends('layouts.app')

@section('title', 'Cadastrar Endereço')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Cadastrar Novo Endereço</h1>

    @if($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cliente.enderecos.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Logradouro:</label>
            <input type="text" name="logradouro" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Número:</label>
            <input type="text" name="numero" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bairro:</label>
            <input type="text" name="bairro" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Cidade:</label>
            <input type="text" name="cidade" class="form-control" required>
        </div>


        <div class="d-grid">
            <button type="submit" class="btn btn-success">Salvar Endereço</button>
        </div>
    </form>
</div>

@endsection
