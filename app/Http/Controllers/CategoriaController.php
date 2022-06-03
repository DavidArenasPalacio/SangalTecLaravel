<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Yajra\Datatables\Datatables; 
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SaveCategoria;
use App\Models\Producto;

class CategoriaController extends Controller
{

    public function index(){
        return view("categoria.index");
    }


    public function listar(){
        $categoria = Categoria::select("categoria.*")->get();

        //return response()->json($categoria);
        return DataTables::of($categoria)
        
        ->editColumn('estado', function($categoria){
            return $categoria->Estado == 1 ? '<a class="cursorBtn button mb-2 bg-theme-1 text-white">Disponible</a>' : '<a class="cursorBtn button mb-2 bg-theme-6 text-white">No Disponible</a>';
        })

        ->addColumn('acciones', function($categoria) {
            $estado = '';

            if (Auth::user()->rol_id == 1) {

                if($categoria->Estado == 1) {
                    $estado = '<a href="/categoria/cambiar/estado/'.$categoria->id.'/0" class="btn btn-danger btn-sm text-red-600"><i class="fas fa-ban"></i></a>';
                    
                }
                else {
                    $estado = '<a href="/categoria/cambiar/estado/'.$categoria->id.'/1" class="btn btn-danger btn-sm text-green-600"><i class="fas fa-check-circle"></i></a>';
                }

                return '<a href="/categoria/editar/'.$categoria->id.'" class="btn btn-secondary btn-sm text-blue-800"><i class="fas fa-edit""></i></a>'.' '.$estado;    
            }

        })
        ->rawColumns(['acciones','estado'])
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
                "Estado"=> 1
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

    public function updateState($id, $estado)
    {
        

        $categoria = Categoria::findOrFail($id);
        $productos = Producto::all();
        
        if ($categoria == null) {
        
            alert()->warning('Error', 'Error al actualizar estado');
            return redirect("/categoria");
        }


        //$productos->update(["Estado" => $estado]);
    

        try {

            $categoria->update([
                'Estado' => $estado
            ]);
            
            foreach ($productos as $value) {
                
                if ($value->categoria_id  == $id) {
                    $producto = Producto::find($value->id);
                    $producto->update([
                        'Estado' => $estado
                    ]);
                }
            }
            alert()->success('Estado actualizado exitosamente');
            return redirect("/categoria");

            
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al actualizar estado');
            return redirect("/categoria");
        }
    }


}
