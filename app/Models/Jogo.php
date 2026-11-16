<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Desenvolvedora;
use App\Models\Plataforma;
use App\Models\Avaliacao;

class Jogo extends Model
{
    protected $table = 'jogos';

    protected $fillable = [
        'nome',
        'desenvolvedora',
        'plataforma',
        'desenvolvedora_id',
        'data_lancamento',
        'preco',
        'categoria_id'
    ];

    protected $casts = [
        'data_lancamento' => 'date',
        'preco' => 'decimal:2'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function desenvolvedoraRelacionada()
    {
        return $this->belongsTo(Desenvolvedora::class, 'desenvolvedora_id');
    }

    public function plataformas()
    {
        return $this->belongsToMany(Plataforma::class, 'jogo_plataforma');
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class, 'jogo_id');
    }
}
