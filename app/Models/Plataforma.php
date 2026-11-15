<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plataforma extends Model
{
    protected $table = 'plataformas';

    protected $fillable = [
        'nome',
        'fabricante',
        'descricao',
    ];

    public function jogos()
    {
        return $this->belongsToMany(Jogo::class, 'jogo_plataforma');
    }
}