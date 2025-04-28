@extends('layouts.app')

@section('title', 'Meus Endereços')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4">Meus Endereços</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <a href="{{ route('cliente.enderecos.create') }}" class="btn btn-success mb-3">Adicionar Novo Endereço</a>

    @if(count($enderecos) > 0)
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Logradouro</th>
                    <th>Número</th>
                    <th>Bairro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enderecos as $endereco)
                    <tr>
                        <td>{{ $endereco->logradouro }}</td>
                        <td>{{ $endereco->numero }}</td>
                        <td>{{ $endereco->bairro }}</td>
                        <td>
                            <a href="{{ route('cliente.enderecos.edit', $endereco) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('cliente.enderecos.destroy', $endereco) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Você ainda não cadastrou endereços.</p>
    @endif

</div>

@endsection
