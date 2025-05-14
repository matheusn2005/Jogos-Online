@extends('layouts.admin')

@section('title', 'Plataformas')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4 shadow">
                <h3 class="text-center mb-4">Cadastrar Nova Categoria</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.categorias.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label>Nome da Categoria:</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('admin.dashboard') }}">← Voltar ao Painel</a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection