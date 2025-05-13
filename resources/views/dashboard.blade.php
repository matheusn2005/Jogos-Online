@extends('layouts.app')

@section('title', 'Dashboard do Cliente')

@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>
        <p class="lead">Você está logado no sistema.</p>

        <a href="{{ route('cliente.compras') }}" class="btn btn-primary mt-3">
            Ver Minhas Compras
        </a>
    </div>
</div>
@endsection
