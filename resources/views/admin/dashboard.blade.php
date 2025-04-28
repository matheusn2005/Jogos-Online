<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="#">Painel do Administrador</a>
        <form method="POST" action="{{ route('admin.logout') }}" class="d-flex">
            @csrf
            <button type="submit" class="btn btn-light">Sair</button>
        </form>
    </div>
</nav>

<!-- Conteúdo -->
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-center">
        <h1>Bem-vindo, {{ Auth::guard('admin')->user()->name ?? 'Administrador' }}!</h1>
        <p class="lead">Você está no painel administrativo.</p>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="card p-4 shadow">

                    <h4>O que você deseja fazer?</h4>

                    <div class="d-grid gap-3 mt-4">
                        <a href="{{ route('admin.produtos.create') }}" class="btn btn-primary">Cadastrar Novo Jogo</a>
                        <a href="{{ route('admin.password.edit') }}" class="btn btn-warning">Alterar Minha Senha</a>
                        <a href="{{ route('admin.register') }}" class="btn btn-success">Cadastrar Novo Administrador</a>
                        <a href="{{ route('admin.categorias.create') }}" class="btn btn-info">Cadastrar Nova Categoria</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
