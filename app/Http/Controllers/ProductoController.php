<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Validation\ValidationException ;
Use  RealRashid\SweetAlert\Facades\Alert;
use Yajra\Datatables\Datatables; 
use App\Http\Requests\SaveProducto;
use App\Http\Requests\UpdateProducto;
class ProductoController extends Controller
{
    
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
            return $producto->Estado == 1 ? '<span class="bg-primary p-1 rounded">Disponible</span>' : '<span class="bg-danger p-1 rounded">No Disponible</span>';
        })
        ->addColumn('acciones', function($producto) {
            $estado = ''; 
            
            if($producto->Estado == 1) {
                $estado = '<a href="/producto/cambiar/estado/'.$producto->id.'/0" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></a>';
            }
            else {
                $estado = '<a href="/producto/cambiar/estado/'.$producto->id.'/1" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-check-circle"></i></a>';
            }
            
            return '<a href="/producto/editar/'.$producto->id.'" class="btn btn-success btn-sm btnEstado"><i class="fas fa-edit"></i></a>'.' '.$estado;
        })
        
        ->rawColumns(['estado', 'acciones'])
        ->make(true);
    }

    public function crear()
    {
        
        $categorias = Categoria::all();

        return view("producto.crear", compact("categorias"));
    }


    public function save(SaveProducto $request)
    {

        $input = $request->all();

        try {
            Producto::create([   
                "categoria_id" => $input["categoria_id"],
                "Nombre_Producto" => $input["nombre"], 
                "Precio_Compra" => $input["precio_compra"],  
                "Precio_Venta" => $input["precio_venta"],  
                "Cantidad" => $input["cantidad"], 
                "Estado" => 1
            ]);
            alert()->success('Producto registrado exitosamente');
            return redirect("/producto");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al registrar el producto');
            return redirect("/producto");
        }
    }


    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::all();

        if ($producto == null) {
            
            return redirect("/producto");
        }

        return view("producto.edit", compact("producto", "categorias"));
    }

    public function update(UpdateProducto $request, $id)
    {

        $input = $request->all();
        try {

            $producto = Producto::find($id);

            if ($producto == null) {
                
                alert()->warning('Error', 'Error al editar el producto');
                return redirect("/producto");
            }

            
            $producto->update([
                "categoria_id" => $input["categoria_id"],
                "Nombre_Producto" => $input["nombre"],
                "Precio_Compra" => $input["precio_compra"],  
                "Precio_Venta" => $input["precio_venta"],  
            ]);
            
            alert()->success('Producto editado exitosamente');
            return redirect("/producto");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al editar el producto');
            return redirect("/producto");
        }
    }

    public function updateState($id, $estado)
    {
        

        $producto = Producto::findOrFail($id);
        if ($producto == null) {
        
            alert()->warning('Error', 'Error al actualizar estado');
            return redirect("/producto");
        }

        try {

            $producto->update(["Estado" => $estado]);
            alert()->success('Estado actualizado exitosamente');
            return redirect("/producto");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al actualizar estado');
            return redirect("/producto");
        }
    }
}
