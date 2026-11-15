<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes';

    protected $fillable = [
        'user_id',
        'jogo_id',
        'nota',
        'comentario',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jogo()
    {
        return $this->belongsTo(Jogo::class);
    }
}