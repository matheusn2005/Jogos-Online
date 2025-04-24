@extends('layouts.site')

@section('title', 'Carrinho')

@section('content')
    <h1 class="mb-4">Carrinho de Compras</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (empty($carrinho))
        <p>Seu carrinho está vazio.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($carrinho as $id => $item)
                    @php
                        $subtotal = $item['quantidade'] * $item['preco'];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item['nome'] }}</td>
                        <td>{{ $item['quantidade'] }}</td>
                        <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('site.carrinho.remover', $id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total: R$ {{ number_format($total, 2, ',', '.') }}</h3>

        <form action="{{ route('site.carrinho.finalizar') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Finalizar Compra</button>
        </form>
    @endif
@endsection