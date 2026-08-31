<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Services\Operations;


class JogoController extends Controller
{
    public function index()
    {
        $jogos = Jogo::with('categoria')->get();

        foreach ($jogos as $jogo) {
            $jogo->encrypted_id = Operations::encryptId($jogo->id);
        }

        return view('jogos.index', compact('jogos'));
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('jogos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'desenvolvedora' => 'required|string|max:255',
            'plataforma' => 'required|string|max:255',
            'data_lancamento' => 'required|date',
            'preco' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        Jogo::create($request->all());

        return redirect()
            ->route('jogos.index')
            ->with('success', 'Jogo cadastrado com sucesso!');
    }

    public function show($id)
    {
        $jogoId = Operations::decryptId($id);

        $jogo = Jogo::find($jogoId);

        $jogo->load('categoria');

        return view('jogos.show', ['jogo' => $jogo]);
    }

    public function edit($id)
    {
        $jogoId = Operations::decryptId($id);

        $jogo = Jogo::find($jogoId);

        $categorias = Categoria::all();

        return view('jogos.edit', ['jogo' => $jogo, 'categorias' => $categorias]);
    }

    public function update(Request $request, $id)
    {
        $jogoId = Operations::decryptId($id);

        $jogo = Jogo::find($jogoId);

        $request->validate([
            'nome' => 'required|string|max:255',
            'desenvolvedora' => 'required|string|max:255',
            'plataforma' => 'required|string|max:255',
            'data_lancamento' => 'required|date',
            'preco' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $jogo->update($request->all());

        return redirect()
            ->route('jogos.index')
            ->with('success', 'Jogo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $jogoId = Operations::decryptId($id);

        $jogo = Jogo::find($jogoId);

        $jogo->delete();

        return redirect()
            ->route('jogos.index')
            ->with('success', 'Jogo excluído com sucesso!');
    }
}

