@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')
<h2 class="mb-4">Finalizar Compra</h2>

@if(session('carrinho') && count(session('carrinho')) > 0)
    <form method="POST" action="{{ route('checkout.processar') }}">
        @csrf

        <div class="mb-3">
            <label for="endereco" class="form-label">Escolha um endereço para entrega</label>
            <select name="endereco_id" class="form-control" required>
                @foreach($enderecos as $endereco)
                    <option value="{{ $endereco->id }}">{{ $endereco->descricao }} - {{ $endereco->cidade->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Confirmar Pedido</button>
        </div>
    </form>
@else
    <p>Seu carrinho está vazio.</p>
@endif
@endsection
