@extends('layouts.site')

@section('title', 'Meu Perfil')

@section('content')
    <h1>Meu Perfil</h1>

    <p><strong>Nome:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <a href="{{ route('site.home') }}" class="btn btn-primary">Voltar para Loja</a>
@endsection
