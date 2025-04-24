@extends('layouts.app')

@section('title', 'Detalhes do Produto')

@section('content')
<h2>{{ $produto->nome }}</h2>
<p>{{ $produto->descricao }}</p>
<p>Categoria: {{ $produto->categoria->nome ?? 'Sem categoria' }}</p>
<p>Plataforma: {{ $produto->plataforma->nome ?? 'N/A' }}</p>
<p>Estoque: {{ $produto->estoque }}</p>
<p>Valor: R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>

<form method="POST" action="{{ route('carrinho.adicionar', $produto->id) }}">
    @csrf
    <button class="btn btn-success">Adicionar ao Carrinho</button>
</form>

<a href="{{ route('produtos.index') }}" class="btn btn-secondary mt-2">Voltar</a>
@endsection
