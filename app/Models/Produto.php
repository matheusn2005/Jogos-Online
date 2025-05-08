<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'quantidade_estoque',
        'slug',
        'valor',
        'categoria_id',
        'plataforma_id',
        'capa',
    ];
    
    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }


    public function fotos()
    {
        return $this->hasMany(FotoProduto::class);
    }

    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'produto_venda')
                    ->withPivot('quantidade', 'subtotal')
                    ->withTimestamps();
    }

    public function imagens()
    {
        return $this->hasMany(\App\Models\ImagemProduto::class);
    }

}

