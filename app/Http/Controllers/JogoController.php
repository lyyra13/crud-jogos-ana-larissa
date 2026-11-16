<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use App\Models\Categoria;
use App\Models\Desenvolvedora;
use App\Models\Plataforma;
use Illuminate\Http\Request;
use App\Services\Operations;

class JogoController extends Controller
{
    public function index()
    {
        $jogos = Jogo::with([
            'categoria',
            'desenvolvedoraRelacionada',
            'plataformas'
        ])->paginate(5);

        foreach ($jogos as $jogo) {
            $jogo->encrypted_id = Operations::encryptId($jogo->id);
        }

        return view('jogos.index', compact('jogos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $desenvolvedoras = Desenvolvedora::all();
        $plataformas = Plataforma::all();

        return view('jogos.create', compact(
            'categorias',
            'desenvolvedoras',
            'plataformas'
        ));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'desenvolvedora_id' => 'required|exists:desenvolvedoras,id',
            'plataformas' => 'required|array|min:1',
            'plataformas.*' => 'required|exists:plataformas,id',
            'data_lancamento' => 'required|date',
            'preco' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $desenvolvedora = Desenvolvedora::findOrFail(
            $dados['desenvolvedora_id']
        );

        $nomesPlataformas = Plataforma::whereIn(
            'id',
            $dados['plataformas']
        )->pluck('nome')->implode(', ');

        $jogo = Jogo::create([
            'nome' => $dados['nome'],
            'desenvolvedora_id' => $desenvolvedora->id,
            'desenvolvedora' => $desenvolvedora->nome,
            'plataforma' => $nomesPlataformas,
            'data_lancamento' => $dados['data_lancamento'],
            'preco' => $dados['preco'],
            'categoria_id' => $dados['categoria_id'],
        ]);

        $jogo->plataformas()->sync($dados['plataformas']);

        return redirect()
            ->route('jogos.index')
            ->with('success', 'Jogo cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $jogoId = Operations::decryptId($id);

        $jogo = Jogo::with('plataformas')->find($jogoId);

        if (!$jogo) {
            return redirect()
                ->route('jogos.index')
                ->with('error', 'Jogo não encontrado.');
        }

        $jogo->encrypted_id = Operations::encryptId($jogo->id);

        $categorias = Categoria::all();
        $desenvolvedoras = Desenvolvedora::all();
        $plataformas = Plataforma::all();

        return view('jogos.edit', compact(
            'jogo',
            'categorias',
            'desenvolvedoras',
            'plataformas'
        ));
    }

    public function update(Request $request, $id)
    {
        $jogoId = Operations::decryptId($id);

        $jogo = Jogo::find($jogoId);

        if (!$jogo) {
            return redirect()
                ->route('jogos.index')
                ->with('error', 'Jogo não encontrado.');
        }

        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'desenvolvedora_id' => 'required|exists:desenvolvedoras,id',
            'plataformas' => 'required|array|min:1',
            'plataformas.*' => 'required|exists:plataformas,id',
            'data_lancamento' => 'required|date',
            'preco' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $desenvolvedora = Desenvolvedora::findOrFail(
            $dados['desenvolvedora_id']
        );

        $nomesPlataformas = Plataforma::whereIn(
            'id',
            $dados['plataformas']
        )->pluck('nome')->implode(', ');

        $jogo->update([
            'nome' => $dados['nome'],
            'desenvolvedora_id' => $desenvolvedora->id,
            'desenvolvedora' => $desenvolvedora->nome,
            'plataforma' => $nomesPlataformas,
            'data_lancamento' => $dados['data_lancamento'],
            'preco' => $dados['preco'],
            'categoria_id' => $dados['categoria_id'],
        ]);

        $jogo->plataformas()->sync($dados['plataformas']);

        return redirect()
            ->route('jogos.index')
            ->with('success', 'Jogo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $jogoId = Operations::decryptId($id);

        $jogo = Jogo::find($jogoId);

        if (!$jogo) {
            return redirect()
                ->route('jogos.index')
                ->with('error', 'Jogo não encontrado.');
        }

        $jogo->delete();

        return redirect()
            ->route('jogos.index')
            ->with('success', 'Jogo excluído com sucesso!');
    }
}
