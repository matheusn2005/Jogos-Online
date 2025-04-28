<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('imagens_produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos')->onDelete('cascade');
            $table->string('imagem'); // caminho da imagem
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagens_produtos');
    }
};
