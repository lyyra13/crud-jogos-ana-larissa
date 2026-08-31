<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('desenvolvedora');
            $table->string('plataforma');
            $table->date('data_lancamento');
            $table->decimal('preco', 10, 2);
            $table->foreignId('categoria_id')->constrained('categorias');
            //categoria_id é uma chave estrangeira que aponta para a tabela categorias.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jogos');
    }
};