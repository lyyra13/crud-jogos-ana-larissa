<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\Categoria; 
use Illuminate\Http\Request; 
use App\Services\Operations; 
 
class CategoriaController extends Controller 
{ 
    public function index() 
    { 
        $categorias = Categoria::with('jogos')->get(); 
 
        foreach ($categorias as $categoria) {
            $categoria->encrypted_id = Operations::encryptId($categoria->id);
        }

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
 
        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    } 
 
    public function edit($id) 
    { 
        $categoriaId = Operations::decryptId($id);

        $categoria = Categoria::find($categoriaId);

        if (!$categoria) {
            return redirect()
                ->route('categorias.index')
                ->with('error', 'Categoria não encontrada.');
        }

        $categoria->encrypted_id = Operations::encryptId($categoria->id);
 
        return view('categorias.edit', ['categoria' => $categoria]); 
    } 
 
    public function update(Request $request, $id) 
    { 
        $categoriaId = Operations::decryptId($id);

        $categoria = Categoria::find($categoriaId);

        if (!$categoria) {
            return redirect()
                ->route('categorias.index')
                ->with('error', 'Categoria não encontrada.');
        }

        $dados = $request->validate([ 
            'nome' => 'required', 
            'descricao' => 'required', 
            'faixa_etaria' => 'required', 
            'status' => 'required', 
        ]); 
 
        $categoria->update($dados); 
 
        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    } 
 
    public function destroy($id) 
    { 
        $categoriaId = Operations::decryptId($id);

        $categoria = Categoria::find($categoriaId);

        if (!$categoria) {
            return redirect()
                ->route('categorias.index')
                ->with('error', 'Categoria não encontrada.');
        }
 
        if ($categoria->jogos()->count() > 0) { 
            return redirect()
                ->route('categorias.index')
                ->with('error', 'Não é possível excluir uma categoria que possui jogos.');
        } 
 
        $categoria->delete(); 
 
        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria excluída com sucesso!');
    } 
}