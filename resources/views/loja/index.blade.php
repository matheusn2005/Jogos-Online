@extends('layouts.app')

@section('title', 'Loja de Jogos')

@section('content')
<h2 class="mb-4">Jogos disponíveis</h2>

<div class="row">
    @foreach($produtos as $produto)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($produto->fotos->first())
                    <img src="{{ asset('storage/' . $produto->fotos->first()->arquivo) }}" class="card-img-top" alt="{{ $produto->nome }}">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $produto->nome }}</h5>
                    <p class="card-text">{{ Str::limit($produto->descricao, 100) }}</p>
                    <h6 class="mt-auto">R$ {{ number_format($produto->valor, 2, ',', '.') }}</h6>
                    <a href="{{ route('produtos.show', $produto->slug) }}" class="btn btn-primary mt-2">Ver detalhes</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
