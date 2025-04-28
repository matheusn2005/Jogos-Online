<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Painel do Cliente</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-light">Sair</button>
        </form>
    </div>
</nav>

<div class="container mt-5">
    <div class="text-center">
        <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>
        <p class="lead">Você está logado no sistema.</p>
    </div>
</div>

</body>
</html>
