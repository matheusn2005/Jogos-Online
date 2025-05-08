@extends('layouts.app')

@section('title', 'Acompanhe seu pedido')

@section('content')

<div class="container mt-4">
    <div class="text-center">
        <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>
        <p class="lead">Acompanhe seu pedido</p>
    </div>
</div>

@endsection