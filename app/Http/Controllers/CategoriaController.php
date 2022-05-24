<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Yajra\Datatables\Datatables; 
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SaveCategoria;
class CategoriaController extends Controller
{

    public function index(){
        return view("categoria.index");
    }


    public function listar(){
        $categoria = Categoria::select("categoria.*")->get();

        //return response()->json($categoria);
        return DataTables::of($categoria)
        
        ->addColumn('acciones', function($categoria) {
            
            if (Auth::user()->rol_id == 1) {

                return '<a href="/categoria/editar/'.$categoria->id.'" class="btn btn-secondary btn-sm text-blue-800"><i class="fas fa-edit""></i></a>';    
            }

        })
        ->rawColumns(['acciones'])
        ->make(true);
    }

    public function crear(){
        return view("categoria.crear");
    }

    public function save(SaveCategoria $request){

        $input = $request->all(); 

        try {

            Categoria::create([
                "Nombre_Categoria"=> $input["nombre"],
            ]);

            alert()->success('Categoría registrada exitosamente');
            return redirect("/categoria");

        } catch (\exception $e) {
            alert()->warning('Error', 'Error al registrar la categoría');
            return redirect("/categoria");
        }
    }
    

    public function edit($id){
        $categoria = Categoria::find($id);

        if ($categoria == null) {
            
            alert()->warning('Error', 'Error al registrar la categoría');
            return redirect("/categoria");
        }
        return view("categoria.edit", compact("categoria"));
    
    }

    public function update(SaveCategoria $request)
    {
        $input = $request->all();

        try {
            $categoria = Categoria::find($input["id"]);

/*             return response()->json($categoria); */
            if ($categoria == null) {
                
                alert()->warning('Error', 'Error al editar la categoría');
                return redirect("/categoria");
            }

            $categoria->update([
                "Nombre_Categoria" => $input["nombre"],
            ]);

        
            alert()->success('Categoría editada exitosamente');
            return redirect("/categoria");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al editar la categoría');
            return redirect("/categoria");
        }
    }




}
