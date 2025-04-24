@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Meus Pedidos</h2>

    @if(count($pedidos) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#Pedido</th>
                    <th>Data</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Ver</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                <tr>
