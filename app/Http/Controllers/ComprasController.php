<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\DetallesCompra;
use App\Models\Compra;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("compra.index");
    }


    public function listar()
    {
        $compra = Compra::select("compra.*", "users.name as users", "proveedor.Nombre_Proveedor as proveedor")->join("users", "users.id", "=", "compra.usuario_id")->join("proveedor", "proveedor.id", "=", "compra.proveedor_id")->get();


        return DataTables::of($compra)
            ->editColumn('estado', function ($compra) {
                return $compra->Estado == 1 ? '<span class="bg-primary p-1 rounded">Activo</span>' : '<span class="bg-danger p-1 rounded">Anulado</span>';
            })
            ->editColumn('created_at', function ($compra) {
                return $compra->created_at->toDateTimeString();
            })
            ->addColumn('acciones', function ($compra) {
                $estado = '';

                if ($compra->Estado == 1) {
                    $estado = '<a href="/compra/cambiar/estado/' . $compra->id . '/0" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
                } else {
                    $estado = '<a  class="btn btn-primary btn-sm btnEstado"><i class="fas fa-unlock"></i></a>';
                }

                return '<a href="/compra/detalle/' . $compra->id . '" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>' . ' ' . $estado;
            })
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }


    public function detalle($id)
    {
        $detal = DetallesCompra::select("detallecompra.*", "productos.Nombre_Producto as producto")
            ->join("productos", "productos.id", "=", "detallecompra.producto_id")
            ->where("detallecompra.compra_id", $id)->get();

        return view("compra.detalle", compact("detal"));
    }


    public function create(){
        $proveedores = Proveedor::all();

        $productos = Producto::all();


        return view("compra.create", compact("proveedores", "productos"));
    }

    public function obtener_Precio($id){
        $obtenterPrecio = Producto::select("productos.Precio")->where("id", $id)->first();
       // dd($obtenterPrecio);
        return $obtenterPrecio;
    }

    public function save(Request $requet)
    {
        $input = $requet->all();

      
        try {
            DB::beginTransaction();

             

            $compra = Compra::create([
                "usuario_id" => Auth()->user()->id,
                "proveedor_id" => $input['proveedor_id'],
                "Precio_total" =>  $input["total"],
                "Estado" => 1
            ]);






            foreach ($input["nombreProducto"] as $key => $value) {


                $productoUpdate = Producto::where("productos.Nombre_Producto", $value)->first();
               
               // return response()->json($productoUpdate->Cantidad);
                
                $productoUpdate->update(["Cantidad" => $productoUpdate->Cantidad + $input["cantidad"][$key]]);
                
/* 
                $productoId = Producto::where("producto.nombre", "=", $value)->first();
 */
                /* $producto = Producto::create([
                    "categoria_id" => $input["categoria_id"][$key],
                    "nombre" => $value,
                    "precio" => $input["precio"][$key],
                    "cantidad" => $input["cantidad"][$key],
                    "estado" => 1
                ]);  */
              
/* 
                return response()->json($productoId["idProducto"]); */
                

            
                DetallesCompra::create([
                    "compra_id" => $compra->id,
                    "producto_id" => $productoUpdate["id"],
                    "Cantidad" => $input["cantidad"][$key],
                    "Sub_total" =>  $input["precio"][$key] * $input["cantidad"][$key]
                ]);
            }

            DB::commit();
            alert()->success('Compra creado Exitosamente');
            return redirect("/compra");
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->warning('Error', 'Error al crear compra');
            return $e;
        }
    }



    public function updateState($id, $estado)
    {
        $compra = Compra::where("compra.id", "=", $id);

        if ($compra == null) {
            return redirect("/compra");
        }


        try {

            if ($estado == 0) {
                $detal = DetallesCompra::select("detallecompra.*", "productos.id as producto")
                    ->join("productos", "productos.id", "=", "detallecompra.producto_id")
                    ->where("detalleCompra.compra_id", $id)->get();

                foreach ($detal as $value) {
                    $producto = Producto::find($value->producto);

   

                    $producto->update(["Cantidad" => $producto->cantidad - $value->cantidad]);
                }
            }



            $compra->update(["Estado" => $estado]);
            alert()->success('Anulada Exitosamente');
            return redirect("/compra");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al anular la compra');
            return redirect("/compra");
        }
    }
}
