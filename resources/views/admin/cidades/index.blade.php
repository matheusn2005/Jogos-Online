@extends('layouts.admin')

@section('title', 'Cidades')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Cidades</h2>
    <a href="{{ route('admin.cidades.create') }}" class="btn btn-primary">Nova Cidade</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cidades as $cidade)
            <tr>
                <td>{{ $cidade->nome }}</td>
                <td>{{ $cidade->estado }}</td>
                <td>
                    <a href="{{ route('admin.cidades.edit', $cidade->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.cidades.destroy', $cidade->id) }}" method="POST" class="d-inline">
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
