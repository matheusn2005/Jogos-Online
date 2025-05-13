@extends('layouts.app')

@section('content')
<div class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4">Dashboard do Administrador</h1>

    {{-- Bloco de botões --}}
    <div class="d-flex flex-wrap gap-3 mb-5">
        <a href="{{ route('admin.produtos.create') }}" class="btn btn-primary btn-lg">Cadastrar Novo Jogo</a>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-secondary btn-lg">Cadastrar Nova Categoria</a>
        <a href="{{ route('admin.plataformas.create') }}" class="btn btn-success btn-lg">Cadastrar Nova Plataforma</a>
        <a href="{{ route('admin.register') }}" class="btn btn-warning btn-lg">Cadastrar Novo Usuário Admin</a>
        <a href="{{ route('admin.password.edit') }}" class="btn btn-dark btn-lg">Alterar Minha Senha</a>
        <a href="{{ route('admin.api-config.index') }}" class="btn btn-info btn-lg">Configurar APIs (Caçapay/Caçalog)</a>

    </div>

    {{-- Bloco de Cards --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total de Clientes</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $clientesCount }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total de Produtos</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $produtosCount }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total de Admins</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $adminsCount }}</h5>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráfico de Vendas --}}
    <div class="card mb-5">
        <div class="card-header">Vendas por Mês</div>
        <div class="card-body">
            <canvas id="vendasChart"></canvas>
        </div>
    </div>

    {{-- Gráficos adicionais --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Novos Clientes por Mês</div>
                <div class="card-body">
                    <canvas id="clientesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Novos Admins por Mês</div>
                <div class="card-body">
                    <canvas id="adminsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5">
        <div class="card-header">Produtos Cadastrados por Mês</div>
        <div class="card-body">
            <canvas id="produtosChart"></canvas>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const meses = {!! json_encode($meses) !!};

    const gerarGrafico = (elementId, label, dados, cor = 'rgba(75, 192, 192, 0.6)') => {
        const ctx = document.getElementById(elementId)?.getContext('2d');
        if (!ctx) return;
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label,
                    data: dados,
                    backgroundColor: cor,
                    borderColor: cor.replace('0.6', '1'),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    };

    gerarGrafico('vendasChart', 'Vendas', {!! json_encode($vendasMensais) !!});
    gerarGrafico('clientesChart', 'Novos Clientes', {!! json_encode($clientesMensais) !!}, 'rgba(54, 162, 235, 0.6)');
    gerarGrafico('adminsChart', 'Novos Admins', {!! json_encode($adminsMensais) !!}, 'rgba(255, 99, 132, 0.6)');
    gerarGrafico('produtosChart', 'Produtos Cadastrados', {!! json_encode($produtosMensais) !!}, 'rgba(255, 206, 86, 0.6)');
</script>
@endsection
