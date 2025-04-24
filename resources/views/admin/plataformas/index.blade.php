@extends('layouts.admin')

@section('title', 'Plataformas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Plataformas</h2>
    <a href="{{ route('admin.plataformas.create') }}" class="btn btn-primary">Nova Plataforma</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($plataformas as $plataforma)
            <tr>
                <td>{{ $plataforma->nome }}</td>
                <td>
                    <a href="{{ route('admin.plataformas.edit', $plataforma->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.plataformas.destroy', $plataforma->id) }}" method="POST" class="d-inline">
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
