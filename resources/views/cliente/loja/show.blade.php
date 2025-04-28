<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $produto->nome }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .galeria-img {
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('loja.index') }}">← Voltar ao Catálogo</a>
    </div>
</nav>

<div class="container mt-5">

    <div class="row">
        <div class="col-md-6">
            @if($produto->capa)
                <img src="{{ asset('storage/' . $produto->capa) }}" class="img-fluid rounded shadow" alt="Capa do Jogo">
            @else
                <img src="https://via.placeholder.com/600x400?text=Sem+Capa" class="img-fluid rounded shadow" alt="Sem Capa">
            @endif
        </div>

        <div class="col-md-6">
            <h1>{{ $produto->nome }}</h1>
            <h4 class="text-success">R$ {{ number_format($produto->valor, 2, ',', '.') }}</h4>
            <p class="mt-4">{{ $produto->descricao }}</p>

            <div class="d-grid gap-2">
                <button class="btn btn-success btn-lg">Adicionar ao Carrinho</button> <!-- Futuro -->
            </div>
        </div>
    </div>

    @if($imagens->count() > 0)
        <hr class="my-5">
        <h3 class="text-center mb-4">Galeria de Gameplay</h3>

        <div class="row">
            @foreach($imagens as $img)
                <div class="col-md-3 mb-4">
                    <img src="{{ asset('storage/' . $img->imagem) }}" class="img-fluid galeria-img rounded shadow-sm" alt="Gameplay">
                </div>
            @endforeach
        </div>
    @endif

</div>

</body>
</html>
