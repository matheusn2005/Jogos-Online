@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4 shadow-sm">
                <h2 class="text-center mb-4">Login do Cliente</h2>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('register') }}" class="text-decoration-none">Não tem conta? Cadastre-se</a>
                    <br>
                    <a href="{{ url('/admin/login') }}" class="text-decoration-none text-danger mt-2 d-block">Login como Administrador</a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
