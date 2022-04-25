<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Yajra\Datatables\Datatables; 
class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view("categoria.index");
    }

     

    public function listar(){
        $categoria = Categoria::select("categoria.*")->get();

        //return response()->json($categoria);
        return DataTables::of($categoria)
        ->addColumn('acciones', function($categoria) {
            

            return '<a href="/categoria/editar/'.$categoria->id.'" class="btn btn-success btn-sm"><i class="fas fa-edit""></i></a>';
        })
        ->rawColumns(['acciones'])
        ->make(true);
    }

    public function create(){
        return view("categoria.create");
    }

    public function save(Request $request){
        // $request->validate(Categoria::$rules);
        $input = $request->all(); 

        try {

            Categoria::create([
                "Nombre_Categoria"=> $input["Nombre_Categoria"],
            ]);

            alert()->success('Categoría creado Exitosamente');
            return redirect("/categoria");

        } catch (\exception $e) {
            alert()->warning('Error', 'Error al crear categoría');
            return redirect("/categoria");
        }
    }
    

    public function edit($id){
        $categoria = Categoria::find($id);

        if ($categoria == null) {
            
            return redirect("/categoria");
        }
        return view("categoria.edit", compact("categoria"));
       
    }

    public function update(Request $request)
    {

        //  $request->validate(Categoria::$rules);

        $input = $request->all();

        
        

        try {
            $categoria = Categoria::find($input["id"]);

           
/*             return response()->json($categoria); */
            if ($categoria == null) {
                
                return redirect("/categoria")->with('error', 'Error al modificar categoría');
            }

            $categoria->update([
                "Nombre_Categoria" => $input["Nombre_Categoria"],
            ]);

          
            alert()->success('Categoría modificado Exitosamente');
            return redirect("/categoria");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al modificar categoría');;
            return redirect("/categoria");
        }
    }




}
