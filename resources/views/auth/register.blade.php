@extends('layouts.app')

@section('title', 'Cadastro de Cliente')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4 shadow-sm">
                <h3 class="text-center mb-4">Cadastrar Conta de Cliente</h3>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nome:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirme a Senha:</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" value="{{ old('cpf') }}" required>
                    </div>


                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('login') }}" class="text-decoration-none">Já tem conta? Faça Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
