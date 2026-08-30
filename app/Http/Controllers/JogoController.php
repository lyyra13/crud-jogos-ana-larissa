<?php

namespace App\Http\Controllers;

use App\Models\Jogo;
use App\Models\Categoria;
use Illuminate\Http\Request;

class JogoController extends Controller
{
    public function index()
    {
        $jogos = Jogo::with('categoria')->get();

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

    public function show(Jogo $jogo)
    {
        $jogo->load('categoria');

        return view('jogos.show', compact('jogo'));
    }

    public function edit(Jogo $jogo)
    {
        $categorias = Categoria::all();

        return view('jogos.edit', compact('jogo', 'categorias'));
    }

    public function update(Request $request, Jogo $jogo)
    {
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

    public function destroy(Jogo $jogo)
    {
        $jogo->delete();

        return redirect()
            ->route('jogos.index')
            ->with('success', 'Jogo excluído com sucesso!');
    }
}
