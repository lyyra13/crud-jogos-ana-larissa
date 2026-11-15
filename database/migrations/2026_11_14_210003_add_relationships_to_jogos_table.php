<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jogos', function (Blueprint $table) {
            $table->foreignId('desenvolvedora_id')
                ->nullable()
                ->constrained('desenvolvedoras')
                ->nullOnDelete();
        });

        Schema::create('jogo_plataforma', function (Blueprint $table) {
            $table->foreignId('jogo_id')
                ->constrained('jogos')
                ->cascadeOnDelete();

            $table->foreignId('plataforma_id')
                ->constrained('plataformas')
                ->cascadeOnDelete();

            $table->primary(['jogo_id', 'plataforma_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jogo_plataforma');

        Schema::table('jogos', function (Blueprint $table) {
            $table->dropForeign(['desenvolvedora_id']);
            $table->dropColumn('desenvolvedora_id');
        });
    }
};