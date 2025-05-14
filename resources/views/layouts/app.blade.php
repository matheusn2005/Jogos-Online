<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Google tag -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4F4C9RMGLB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-4F4C9RMGLB');
    </script>
    
    <meta charset="UTF-8">
    <title>@yield('title', 'Jogos Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('loja.index') }}">Jogos Online</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Minha Conta
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('cliente.carrinho.index') }}">Carrinho</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cliente.dashboard') }}">Dashboard</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cliente.compras') }}">Ver Minhas Compras</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cliente.entregas') }}">Minhas Entregas</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cliente.senha.edit') }}">Alterar Senha</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
