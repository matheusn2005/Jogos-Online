<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'cpf', 'rg', 'data_nascimento',
        'telefone', 'email', 'senha',
    ];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
