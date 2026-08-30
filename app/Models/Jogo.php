<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    protected $table = 'jogos';

    protected $fillable = [
        'nome',
        'desenvolvedora',
        'plataforma',
        'data_lancamento',
        'preco',
        'categoria_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}