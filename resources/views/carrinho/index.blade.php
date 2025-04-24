@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
<h2>Seu Carrinho</h2>

@if (session('carrinho') && count(session('carrinho')) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach (session('carrinho') as $item)
                @php $total += $item['quantidade'] * $item['valor']; @endphp
                <tr>
                    <td>{{ $item['nome'] }}</td>
                    <td>{{ $item['quantidade'] }}</td>
                    <td>R$ {{ number_format($item['quantidade'] * $item['valor'], 2, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="text-end"><strong>Total:</strong></td>
                <td><strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
    <a href="{{ route('checkout') }}" class="btn btn-success">Finalizar Compra</a>
@else
    <p>Seu carrinho está vazio.</p>
@endif
@endsection
