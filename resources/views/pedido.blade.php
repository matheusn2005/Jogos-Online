@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Detalhes do Pedido #{{ $pedido->id }}</h2>

    <p><strong>Data:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($pedido->status) }}</p>
    <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

    <h4 class="mt-4">Itens do Pedido:</h4>
    <ul class="list-group">
        @foreach($pedido->itens as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $item->produto_nome }} (x{{ $item->quantidade }})
                <span>R$ {{ number_format($item->preco * $item->quantidade, 2, ',', '.') }}</span>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('pedidos') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
