@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')

<div class="container mt-4">
    <h1 class="mb-4 text-center">Finalizar Compra</h1>

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('cliente.carrinho.finalizar') }}">
        @csrf

        <div class="card p-4 shadow-sm mb-4">
            <h4 class="mb-3">Selecione um Endereço de Entrega</h4>

            @if(count($enderecos) > 0)
                <div class="mb-3">
                    <select name="endereco_id" class="form-select" required>
                        <option value="">-- Selecione --</option>
                        @foreach($enderecos as $endereco)
                            <option value="{{ $endereco->id }}">
                                {{ $endereco->logradouro }}, {{ $endereco->numero }} - {{ $endereco->bairro }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @else
            <div class="alert alert-warning text-center">
                Você não possui endereços cadastrados! 
                <br><br>
                <a href="{{ route('cliente.enderecos.create') }}" class="btn btn-sm btn-primary">
                    Cadastrar Novo Endereço
                </a>
            </div>
            @endif
        </div>

        <div class="card p-4 shadow-sm mb-4">
            <h4 class="mb-3">Resumo da Compra</h4>

            <ul class="list-group mb-3">
                @php $total = 0; @endphp
                @foreach($carrinho as $item)
                    @php $subtotal = $item['preco'] * $item['quantidade']; @endphp
                    @php $total += $subtotal; @endphp
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{ $item['nome'] }}</h6>
                            <small class="text-muted">Quantidade: {{ $item['quantidade'] }}</small>
                        </div>
                        <span class="text-muted">R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <strong>Total:</strong>
                    <strong>R$ {{ number_format($total, 2, ',', '.') }}</strong>
                </li>
            </ul>
        </div>

        @if(count($enderecos) > 0)
            <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg">Finalizar Compra</button>
            </div>
        @endif

    </form>

</div>

@endsection
