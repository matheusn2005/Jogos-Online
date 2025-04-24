@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Finalizar Compra</h2>

    @if(session('carrinho') && count(session('carrinho')) > 0)
        <form action="{{ route('checkout.processar') }}" method="POST" class="w-75 mx-auto">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" name="endereco" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="pagamento" class="form-label">Forma de Pagamento</label>
                <select name="pagamento" class="form-select" required>
                    <option value="pix">Pix</option>
                    <option value="boleto">Boleto</option>
                    <option value="cartao">Cartão de Crédito</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Confirmar Pedido</button>
        </form>
    @else
        <p class="text-center">Seu carrinho está vazio.</p>
    @endif
</div>
@endsection
