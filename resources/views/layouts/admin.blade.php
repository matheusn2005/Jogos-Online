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
    <title>@yield('title', 'Painel Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Painel Admin</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarAdmin">
            <ul class="navbar-nav">
                @auth('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Área Administrativa
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.produtos.create') }}">Cadastrar Novo Jogo</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.categorias.create') }}">Cadastrar Nova Categoria</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.plataformas.create') }}">Cadastrar Nova Plataforma</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.register') }}">Cadastrar Novo Usuário Admin</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.password.edit') }}">Alterar Minha Senha</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.api-config.index') }}">Configurar APIs (Caçapay/Caçalog)</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
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
