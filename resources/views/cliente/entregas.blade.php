@extends('layouts.app')

@section('title', 'Gerenciar Entregas')

@section('content')
<div class="container mt-4">
    <h2>Status das Entregas</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID da Compra</th>
                <th>Cliente</th>
                <th>Status Atual</th>
                <th>Atualizar</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($compras as $compra)
            <tr>
                <td>#{{ $compra->id }}</td>
                <td>{{ $compra->user->name ?? 'Cliente não identificado' }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $compra->status_entrega)) }}</td>
                <td>
                    <form method="POST" action="{{ route('entregas.atualizar', $compra->id) }}">
                        @csrf
                        <select name="status_entrega" class="form-select d-inline w-auto">
                            <option value="pendente" {{ $compra->status_entrega == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="a_caminho" {{ $compra->status_entrega == 'a_caminho' ? 'selected' : '' }}>A Caminho</option>
                            <option value="entregue" {{ $compra->status_entrega == 'entregue' ? 'selected' : '' }}>Entregue</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Nenhuma entrega pendente.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
