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
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SaveCompra;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ComprasController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        return view("compra.index");
    }


    public function listar()
    {
        $compra = Compra::select("compra.*", "users.name as users", "proveedor.Nombre_Proveedor as proveedor")->join("users", "users.id", "=", "compra.usuario_id")
            ->join("proveedor", "proveedor.id", "=", "compra.proveedor_id")
            ->get();


        return DataTables::of($compra)
            ->editColumn('estado', function ($compra) {
                return $compra->Estado == 1 ? '<a class="btn btn-success">Activa</a>' : '<a class="btn btn-danger">Anulada</a>';
            })
            ->editColumn('created_at', function ($compra) {
                return $compra->created_at->toDateTimeString();
            })
            ->addColumn('acciones', function ($compra) {
                $estado = '';

                if (Auth::user()->rol_id == 1) {

                    if ($compra->Estado == 1) {
                        $estado = '<a href="/compra/cambiar/estado/' . $compra->id . '/0" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></a>';
                    } else {
                        $estado = '<a  class="btn btn-success btn-sm btnEstado"><i class="fas fa-ban"></i></a>';
                    }
                }

                return '<a href="/compra/detalle/' . $compra->id . '" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>' . ' ' . $estado;
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


    public function crear()
    {

        $productos = Producto::select("productos.*")
            ->where("productos.Estado", "=", 1)
            ->get();

        $proveedores = Proveedor::select("proveedor.*")
            ->where("proveedor.Estado", "=", 1)
            ->get();


        return view("compra.crear", compact("proveedores", "productos"));
    }

    // public function obtener_Precio($id){
    //     $obtenterPrecio = Producto::select("productos.Precio_Compra")->where("id", $id)->first();

    //     return $obtenterPrecio;
    // }

    public function save(Request $request)
    {;
        $input = $request->all();
       //dd($input);
        try {
            DB::beginTransaction();


        $compra = Compra::create([
            "usuario_id" => Auth()->user()->id,
            "proveedor_id" => $input['proveedor_id'],
            "Precio_total" =>  $input["total"],
            "Estado" => 1
        ]);

        

        foreach ($input["idP"] as $key => $value) {


            $detallecompra = DetallesCompra::create([

                "producto_id" => $value,
                "compra_id" => $compra->id,
                "Precio_unitario" => $input["precios"][$key],
                "Cantidad" => $input["cantidades"][$key],
                "Sub_total" =>  $input["precios"][$key] * $input["cantidades"][$key]
            ]);

            $productoUpdate = Producto::findOrFail($value);

            
            $productoUpdate->update(["Cantidad" => $productoUpdate->Cantidad + $input["cantidades"][$key]]);
            

        }

            DB::commit();
            alert()->success('Compra registrada exitosamente');
            return redirect("/compra");
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->warning('Error', 'Error al registrar la compra');
            return redirect("/compra");
        }
    }



    public function updateState($id, $estado)
    {
        $compra = Compra::find($id);

        if ($compra == null) {
            alert()->warning('Error', 'Error al anular la compra');
            return redirect("/compra");
        }

        try {

            if ($estado == 0) {

                $detal = DetallesCompra::select("detallecompra.*", "productos.id as Productos", "detallecompra.Cantidad as Cantidad")
                    ->join("productos", "detallecompra.producto_id", "=", "productos.id")
                    ->where("detalleCompra.compra_id", "=", $id)
                    ->get();

                foreach ($detal as $value) {


                    $productos = Producto::find($value->Productos);

                    $productos->update(["Cantidad" => $productos->Cantidad - $value->Cantidad]);
                }
            }

            $compra->update(["Estado" => $estado]);
            alert()->success('Compra anulada exitosamente');
            return redirect("/compra");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al anular la compra');
            return redirect("/compra");
        }
    }
}