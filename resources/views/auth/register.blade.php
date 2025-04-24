@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 450px;">
    <h3 class="text-center mb-4">Criar Conta</h3>

    <form action="{{ route('register.processar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form
