@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Minhas Compras</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($compras->isEmpty())
        <p>Nenhuma compra realizada ainda.</p>
    @else
        <table class="table table-bordered mt-4">
            <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compras as $venda)
                    <tr>
                        <td>{{ $venda->id }}</td>
                        <td>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                        <td>
                            @if($venda->status == 'pago')
                                <span class="badge bg-success">Pago</span>
                            @elseif($venda->status == 'pendente')
                                <span class="badge bg-warning text-dark">Pendente</span>
                            @else
                                <span class="badge bg-danger">Negado</span>
                            @endif
                        </td>
                        <td>{{ $venda->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
