<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Validation\ValidationException ;
Use  RealRashid\SweetAlert\Facades\Alert;
use Yajra\Datatables\Datatables; 
class ProductoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        return view("producto.index");
    }  


    public function listar(){
        $producto = Producto::select("productos.*", "categoria.Nombre_Categoria as categoria")
        ->join("categoria", "categoria.id", "=", "productos.categoria_id")
        ->get();
       // return response()->json($producto);
        return DataTables::of($producto)
        ->editColumn('estado', function($producto){
            return $producto->Estado == 1 ? '<span class="bg-primary p-1 rounded">Activo</span>' : '<span class="bg-danger p-1 rounded">Inactivo</span>';
        })
        ->addColumn('acciones', function($producto) {
            $estado = ''; 
              
            if($producto->Estado == 1) {
                $estado = '<a href="/producto/cambiar/estado/'.$producto->id.'/0" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
            }
            else {
                $estado = '<a href="/producto/cambiar/estado/'.$producto->id.'/1" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-unlock"></i></a>';
            }
            
            return '<a href="/producto/editar/'.$producto->id.'" class="btn btn-success btn-sm btnEstado"><i class="fas fa-edit"></i></a>'.' '.$estado;
        })
        ->rawColumns(['estado', 'acciones'])
        ->make(true);
    }




    public function create(){
        $categorias = Categoria::all();

        return view("producto.create", compact("categorias"));
    }  


    public function save(Request $request)
    {
        //dd($request->all());
       $request->validate(Producto::$rules);
       
        $input = $request->all();
        //return response()->json($request);
        try {
            Producto::create([   
                "categoria_id" => $input["categoria_id"],
                "Nombre_Producto" => $input["Nombre_Producto"], 
                "Precio" => $input["Precio"],    
                "Cantidad" => $input["Cantidad"], 
                "Estado" => 1
            ]);
            alert()->success('Producto creado Exitosamente');
            return redirect("/producto/crear");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al crear Producto');
            return redirect("/producto/crear")->with('error', 'Error al crear producto');;
        }
    }


    public function edit($id)
    {
        $producto = Producto::where("productos.id","=",$id)->first();
        $categorias = Categoria::all();
        //return response()->json($producto); 
        if ($producto == null) {
            
            return redirect("/producto");
        }

        return view("producto.edit", compact("producto", "categorias"));
    }

    public function update(Request $request)
    {

       //$request->validate(Producto::$rules);

        $input = $request->all();
        //return dd($request);
        try {
            $producto = Producto::where("productos.id", "=", $input["id"]);
            

            if ($producto == null) {
                
                return redirect("/producto")->with('error', 'Error al modificar producto');
            }

            
            $producto->update([
                "categoria_id" => $input["categoria_id"],
                "Nombre_Producto" => $input["nombre"],
                "Precio" => $input["precio"]
            ]);

          
            alert()->success('Producto modificado Exitosamente');
            return redirect("/producto");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al Modificar Producto');
            return redirect("/producto");
        }
    }

    public function updateState($id, $estado)
    {
        

        $producto = Producto::where("productos.id", "=", $id);

        if ($producto == null) {
          
            return redirect("/producto");
        }


        try {
            // example:


            $producto->update(["Estado" => $estado]);
            alert()->success('Estado modificado Exitosamente');
            return redirect("/producto")->with('success', 'Estado modificado satisfactoriamente!');
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al Modificar estado');
            return redirect("/producto")->with('error', 'Error al modifcar estado');
        }
    }
}
 