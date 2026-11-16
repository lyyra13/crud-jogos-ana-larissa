<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Jogo;
use App\Services\Operations;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index($id)
    {
        $jogoId = Operations::decryptId($id);

        $jogo = Jogo::findOrFail($jogoId);

        $avaliacoes = Avaliacao::with('usuario')
            ->where('jogo_id', $jogo->id)
            ->latest()
            ->get();

        $minhaAvaliacao = Avaliacao::where('jogo_id', $jogo->id)
            ->where('user_id', auth()->id())
            ->first();

        $media = $avaliacoes->avg('nota');

        return view('avaliacoes.index', compact(
            'jogo',
            'avaliacoes',
            'minhaAvaliacao',
            'media'
        ));
    }

    public function store(Request $request, $id)
    {
        $jogoId = Operations::decryptId($id);

        $jogo = Jogo::findOrFail($jogoId);

        $dados = $request->validate([
            'nota' => 'required|integer|min:1|max:5',
            'comentario' => 'nullable|string|max:1000',
        ]);

        Avaliacao::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'jogo_id' => $jogo->id,
            ],
            [
                'nota' => $dados['nota'],
                'comentario' => $dados['comentario'] ?? null,
            ]
        );

        return redirect()
            ->route('jogos.avaliacoes', $id)
            ->with('success', 'Avaliação salva com sucesso!');
    }
}
