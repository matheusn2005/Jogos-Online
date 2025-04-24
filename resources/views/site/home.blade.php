@extends('layouts.site')

@section('title', 'Home')

@section('content')
    <h1 class="mb-4">Jogos disponíveis</h1>

    <div class="row">
        @foreach ($produtos as $produto)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produto->nome }}</h5>
                        <p class="card-text">{{ Str::limit($produto->descricao, 100) }}</p>
                        <p><strong>R$ {{ number_format($produto->valor, 2, ',', '.') }}</strong></p>
                        <a href="{{ route('site.produto', $produto->slug) }}" class="btn btn-primary">Ver detalhes</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
