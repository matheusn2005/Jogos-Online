<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cidade extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'estado'];

    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }
}

