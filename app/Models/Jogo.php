<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

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

    protected $casts = [
    'data_lancamento' => 'date',
    'preco' => 'decimal:2',
];
}