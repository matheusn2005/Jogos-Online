<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['valor_total', 'cliente_id', 'endereco_id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produto_venda')
                    ->withPivot('quantidade', 'subtotal')
                    ->withTimestamps();
    }
}

