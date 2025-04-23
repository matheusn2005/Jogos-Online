<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao', 'logradouro', 'numero',
        'bairro', 'cidade_id', 'cliente_id',
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}

