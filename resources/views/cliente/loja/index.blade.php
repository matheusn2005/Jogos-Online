@extends('layouts.app')

@section('title', 'Catálogo de Jogos')

@section('content')

<style>
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
</style>

<div class="container mt-4">
    <div class="row">
        @foreach($produtos as $produto)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    @if($produto->capa)
                        <img src="{{ asset('storage/' . $produto->capa) }}" class="card-img-top" alt="Capa do Jogo">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Sem+Capa" class="card-img-top" alt="Sem Capa">
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $produto->nome }}</h5>

                        @if($produto->categoria)
                            <p class="text-muted">{{ $produto->categoria->nome }}</p>
                        @endif

                        <p class="card-text">R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>

                        <a href="{{ route('loja.show', $produto->slug) }}" class="btn btn-primary mb-2">Ver Jogo</a>
                        <a href="{{ route('cliente.carrinho.adicionar', $produto->id) }}" class="btn btn-success">Adicionar ao Carrinho</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
