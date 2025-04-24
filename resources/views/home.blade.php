@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>Bem-vindo, {{ auth()->user()->nome ?? 'Usuário' }}!</h2>
    <p class="mt-3">Explore nossos jogos, veja seus pedidos ou gerencie sua conta.</p>
    
    <a href="{{ route('produtos') }}" class="btn btn-primary mt-4">Ver Jogos</a>
</div>
@endsection
