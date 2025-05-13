<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up()
    {
        Schema::create('api_configs', function (Blueprint $table) {
            $table->id();
            $table->string('cacapay_url')->nullable();
            $table->string('cacapay_token')->nullable();
            $table->string('cacalog_url')->nullable();
            $table->string('cacalog_token')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_configs');
    }
};
