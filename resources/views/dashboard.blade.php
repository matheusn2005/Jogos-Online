@extends('layouts.app')

@section('title', 'Dashboard do Cliente')

@section('content')
<div class="container mt-4">
    <div class="text-center">
        <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>
        <p class="lead">Você está logado no sistema.</p>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('cliente.compras') }}" class="btn btn-primary">
                Ver Minhas Compras
            </a>
            <a href="{{ route('cliente.entregas') }}" class="btn btn-outline-primary">
                Minhas Entregas
            </a>
        </div>
    </div>
</div>
@endsection
