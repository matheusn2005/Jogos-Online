@extends('layouts.app')

@section('title', 'Meu Carrinho')

@section('content')

@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<h1 class="mb-4 text-center">Meu Carrinho</h1>

@if(count($carrinho) > 0)
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($carrinho as $id => $item)
                    @php $subtotal = $item['preco'] * $item['quantidade']; @endphp
                    @php $total += $subtotal; @endphp
                    <tr>
                        <td>
                            @if($item['capa'])
                                <img src="{{ asset('storage/' . $item['capa']) }}" width="80" class="img-thumbnail">
                            @else
                                <img src="https://via.placeholder.com/80x80?text=Sem+Capa" width="80" class="img-thumbnail">
                            @endif
                        </td>
                        <td>{{ $item['nome'] }}</td>
                        <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                        <td>{{ $item['quantidade'] }}</td>
                        <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                        <td>
                            <a href="	route('cliente.carrinho.remover', $id)" class="btn btn-sm btn-danger">Remover</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
        @if(count($carrinho) > 0)
            <div class="d-grid mt-4">
                <a href="{{ route('cliente.carrinho.checkout') }}" class="btn btn-success btn-lg">
                    Finalizar Compra 🛒
                </a>
            </div>
        @endif

    </div>
@else
    <p class="text-center">Seu carrinho está vazio 😢</p>
@endif

@endsection
