<?php

namespace App\Http\Controllers;

use App\Models\Desenvolvedora;
use Illuminate\Http\Request;

class DesenvolvedoraController extends Controller
{
    public function index()
    {
        $desenvolvedoras = Desenvolvedora::paginate(5);

        return view('desenvolvedoras.index', compact('desenvolvedoras'));
    }

    public function create()
    {
        return view('desenvolvedoras.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:desenvolvedoras,nome',
            'pais' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Desenvolvedora::create($request->all());

        return redirect()
            ->route('desenvolvedoras.index')
            ->with('success', 'Desenvolvedora cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $desenvolvedora = Desenvolvedora::findOrFail($id);

        return view('desenvolvedoras.edit', compact('desenvolvedora'));
    }

    public function update(Request $request, $id)
    {
        $desenvolvedora = Desenvolvedora::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255|unique:desenvolvedoras,nome,' . $id,
            'pais' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $desenvolvedora->update($request->all());

        return redirect()
            ->route('desenvolvedoras.index')
            ->with('success', 'Desenvolvedora atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $desenvolvedora = Desenvolvedora::findOrFail($id);

        $desenvolvedora->delete();

        return redirect()
            ->route('desenvolvedoras.index')
            ->with('success', 'Desenvolvedora excluída com sucesso!');
    }
}