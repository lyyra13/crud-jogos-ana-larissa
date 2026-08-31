<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\Categoria; 
use Illuminate\Http\Request; 
use App\Services\Operations; 
 
class CategoriaController extends Controller 
{ 
    public function index() 
    { 
        $categorias = Categoria::all(); 
 
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
 
        return redirect()->route('categorias.index'); 
    } 
 
    public function edit($id) 
    { 
        $categoriaId = Operations::decryptId($id);

        $categoria = Categoria::find($categoriaId); 
 
        return view('categorias.edit', ['categoria' => $categoria]); 
    } 
 
    public function update(Request $request, $id) 
    { 
        $categoriaId = Operations::decryptId($id);

        $categoria = Categoria::find($categoriaId);

        $dados = $request->validate([ 
            'nome' => 'required', 
            'descricao' => 'required', 
            'faixa_etaria' => 'required', 
            'status' => 'required', 
        ]); 
 
        $categoria->update($dados); 
 
        return redirect()->route('categorias.index'); 
    } 
 
    public function destroy($id) 
    { 
        $categoriaId = Operations::decryptId($id);

        $categoria = Categoria::find($categoriaId); 
 
        if ($categoria->jogos()->count() > 0) { 
            return redirect()->route('categorias.index'); 
        } 
 
        $categoria->delete(); 
 
        return redirect()->route('categorias.index'); 
    } 
}