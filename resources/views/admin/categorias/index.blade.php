@extends('layouts.admin')

@section('title', 'Categorias')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categorias</h2>
    <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">Nova Categoria</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Categoria Pai</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->nome }}</td>
                <td>{{ $categoria->categoriaPai->nome ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
