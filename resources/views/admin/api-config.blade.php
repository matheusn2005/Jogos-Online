@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Configuração de APIs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.api-config.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">URL da API Caçapay</label>
            <input type="url" name="cacapay_url" class="form-control" value="{{ old('cacapay_url', $config->cacapay_url ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Token da API Caçapay</label>
            <input type="text" name="cacapay_token" class="form-control" value="{{ old('cacapay_token', $config->cacapay_token ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">URL da API Caçalog</label>
            <input type="url" name="cacalog_url" class="form-control" value="{{ old('cacalog_url', $config->cacalog_url ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Token da API Caçalog</label>
            <input type="text" name="cacalog_token" class="form-control" value="{{ old('cacalog_token', $config->cacalog_token ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Configurações</button>
    </form>
</div>
@endsection
