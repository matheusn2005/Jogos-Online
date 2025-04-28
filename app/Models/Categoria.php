<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'categoria_pai'];

    public function subcategorias()
    {
        return $this->hasMany(Categoria::class, 'categoria_pai');
    }

    public function categoriaPai()
    {
        return $this->belongsTo(Categoria::class, 'categoria_pai');
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}

