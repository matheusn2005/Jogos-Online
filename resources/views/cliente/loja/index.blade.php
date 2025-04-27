<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Jogos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Catálogo de Jogos</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        @foreach($produtos as $produto)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    @if($produto->capa)
                        <img src="{{ asset('storage/' . $produto->capa) }}" class="card-img-top" alt="Capa do Jogo">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Sem+Capa" class="card-img-top" alt="Sem Capa">
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $produto->nome }}</h5>
                            @if($produto->categoria)
                                <p class="text-muted">{{ $produto->categoria->nome }}</p>
                            @endif

                        <p class="card-text">R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>
                        <a href="{{ route('loja.show', $produto->slug) }}" class="btn btn-primary">Ver Jogo</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
