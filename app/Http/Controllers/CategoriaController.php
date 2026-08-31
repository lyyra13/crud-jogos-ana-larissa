<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'faixa_etaria' => 'required',
            'status' => 'required',
        ]);

        Categoria::create($dados);

        return redirect()->route('categorias.index');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $dados = $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'faixa_etaria' => 'required',
            'status' => 'required',
        ]);

        $categoria = Categoria::findOrFail($id);

        $categoria->update($dados);

        return redirect()->route('categorias.index');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria->jogos()->count() > 0) {
            return redirect()->route('categorias.index');
        }

        $categoria->delete();

        return redirect()->route('categorias.index');
    }
}