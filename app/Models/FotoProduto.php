<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FotoProduto extends Model
{
    use HasFactory;

    protected $fillable = ['nome_arquivo', 'produto_id'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
