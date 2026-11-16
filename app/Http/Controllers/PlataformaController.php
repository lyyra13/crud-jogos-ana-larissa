<?php

namespace App\Http\Controllers;

use App\Models\Plataforma;
use Illuminate\Http\Request;

class PlataformaController extends Controller
{
    public function index()
    {
        $plataformas = Plataforma::paginate(5);

        return view('plataformas.index', compact('plataformas'));
    }

    public function create()
    {
        return view('plataformas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:plataformas,nome',
            'fabricante' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Plataforma::create($request->all());

        return redirect()
            ->route('plataformas.index')
            ->with('success', 'Plataforma cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $plataforma = Plataforma::findOrFail($id);

        return view('plataformas.edit', compact('plataforma'));
    }

    public function update(Request $request, $id)
    {
        $plataforma = Plataforma::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255|unique:plataformas,nome,' . $id,
            'fabricante' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $plataforma->update($request->all());

        return redirect()
            ->route('plataformas.index')
            ->with('success', 'Plataforma atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $plataforma = Plataforma::findOrFail($id);

        $plataforma->delete();

        return redirect()
            ->route('plataformas.index')
            ->with('success', 'Plataforma excluída com sucesso!');
    }
}