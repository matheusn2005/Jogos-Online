<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Jogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow">
                <h3 class="text-center mb-4">Cadastrar Novo Jogo</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $erro)
                                <li>{{ $erro }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.produtos.store') }}" enctype="multipart/form-data">
                @csrf

                    <div class="mb-3">
                        <label>Nome do Jogo:</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Descrição:</label>
                        <textarea name="descricao" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Quantidade em Estoque:</label>
                        <input type="number" name="quantidade_estoque" class="form-control" required min="0">
                    </div>

                    <div class="mb-3">
                        <label>Valor (R$):</label>
                        <input type="number" step="0.01" name="valor" class="form-control" required min="0">
                    </div>

                    <div class="mb-3">
                        <label>Imagem de Capa:</label>
                        <input type="file" name="capa" class="form-control" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label>Imagens de Gameplay (até 5):</label>
                        <input type="file" name="imagens[]" class="form-control" accept="image/*" multiple>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Cadastrar Jogo</button>
                    </div>

                    <!-- Nome, descrição, estoque e valor aqui (não muda) -->

                    <div class="mb-3">
                        <label>Categoria do Jogo:</label>
                        <select name="categoria_id" class="form-control" required>
                            <option value="">Selecione uma categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo de capa, imagens e botão de envio continuam normais -->
                </form>


                <div class="text-center mt-3">
                    <a href="{{ route('admin.dashboard') }}">← Voltar ao Painel</a>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
