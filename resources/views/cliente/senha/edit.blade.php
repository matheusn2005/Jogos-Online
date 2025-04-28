@extends('layouts.app')

@section('title', 'Alterar Senha')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm p-4">
                <h2 class="text-center mb-4">Alterar Senha</h2>

                <form method="POST" action="{{ route('cliente.senha.update') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Senha Atual:</label>
                        <input type="password" name="senha_atual" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nova Senha:</label>
                        <input type="password" name="nova_senha" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirme a Nova Senha:</label>
                        <input type="password" name="nova_senha_confirmation" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Atualizar Senha</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
