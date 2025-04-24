@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2 class="text-success mb-4">Pedido Realizado com Sucesso!</h2>
    <p>Obrigado por comprar conosco. Você receberá a confirmação por e-mail em breve.</p>
    
    <a href="{{ route('home') }}" class="btn btn-secondary mt-4">Voltar para a Página Inicial</a>
</div>
@endsection
