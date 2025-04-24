@extends('layouts.admin')

@section('title', isset($categoria) ? 'Editar Categoria' : 'Nova Categoria')

@section('content')
<h2>{{ isset($categoria) ? 'Editar Categoria' : 'Nova Categoria' }}</h2>

<form method="POST" action="{{ isset($categoria) ? route('admin.categorias.update', $categoria->id) : route('admin.categorias.store') }}">
    @csrf
    @if(isset($categoria))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ $categoria->nome ?? '' }}" required>
    </div>

    <div class="mb-3">
        <label for="categoria_pai_id" class="form-label">Categoria Pai (se tiver)</label>
        <select name="categoria_pai_id" class="form-control">
            <option value="">Nenhuma</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" {{ isset($categoria) && $categoria->categoria_pai_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection
