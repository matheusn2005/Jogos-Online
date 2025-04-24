@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Jogos em Destaque</h2>
    <div class="row">
        @foreach ($produtos as $produto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if ($produto->fotos->first())
                        <img src="{{ asset('storage/' . $produto->fotos->first()->arquivo) }}" class="card-img-top" alt="{{ $produto->nome }}">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Sem+Imagem" class="card-img-top" alt="Sem Imagem">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $produto->nome }}</h5>
                        <p class="card-text">{{ Str::limit($produto->descricao, 100) }}</p>
                        <p class="card-text fw-bold">R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>
                        <a href="{{ route('carrinho.adicionar', $produto->id) }}" class="btn btn-primary mt-auto">Comprar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
