<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Jogos Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('loja.index') }}">Jogos Online</a>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('cliente.carrinho.index') }}" class="nav-link">🛒 Carrinho</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cliente.dashboard') }}" class="nav-link">🏠 Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cliente.senha.edit') }}" class="nav-link">🔑 Alterar Senha</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-danger btn-sm ms-2">Sair</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo -->
<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
