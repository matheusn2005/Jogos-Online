<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiConfig extends Model
{
    protected $fillable = [
        'cacapay_url',
        'cacapay_token',
        'cacalog_url',
        'cacalog_token',
    ];

    // ✅ Adicione isso para evitar problemas com firstOrNew(['id' => 1])
    public $incrementing = false;
    protected $primaryKey = 'id';
}
