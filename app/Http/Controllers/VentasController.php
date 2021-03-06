<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveVenta;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Ventas;
use App\Models\Producto;
use App\Models\Clientes;
use App\Models\VentasDetalle;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
{
    public function index()
    {        
        $productos = Producto::all();
        $clientes = Clientes::all();;

        return view('ventas.index', compact('productos','clientes'));
    }

    public function crear()
    {
        
        
        $productos = Producto::select("productos.*")
        ->where("productos.Estado", "=", 1)
        ->get();
        // return response()->json($productos);
        $clientes = Clientes::all();;

        return view('ventas.crear', compact('productos','clientes'));
    }

    public function store(SaveVenta $request)
    {
    
        $input = $request->all();
        if ($input == null) {
            alert()->warning('error', 'Error al registrar la venta');
            return redirect("/ventas");
        }
        
       /*  dd($input); */
        //validacion para que la cantidad a vender no sea mayor al stock disponible
        foreach ($input["Producto"] as $key => $value) {
            $productosRecorridos = Producto::findOrFail($value);

            if ($input["cantidades"][$key] > $productosRecorridos->Cantidad) {
                // return redirect('/ventas')->with(Cantidad insuficiente', 'el stock de '. $productosRecorridos->Nombre_Producto .' es insuficiente');
            
                alert()->warning('Cantidad insuficiente', 'el stock de '. $productosRecorridos->Nombre_Producto .' es insuficiente');
                return redirect("/ventas/crear");
            }
        } 

    try {
    
    DB::beginTransaction();

        $ventas = Ventas::create([
            'cliente_id' => $input["nombreC"],
            'usuario_id' => auth()->user()->id,
            'Precio_total' => $input["total"],
            'Estado' => 1,
        ]);
        
        

        foreach ($input["Producto"] as $key => $value) {

          
            $ventasdetalle = VentasDetalle::create([

                'producto_id' => $value,
                'venta_id' => $ventas->id,
                'Precio_unitario' => $input["precios"][$key],
                'Cantidad' => $input["cantidades"][$key],
                'Sub_total' => $input["precios"][$key] * $input["cantidades"][$key],
            ]);

            // return dd($ventasdetalle);
            //esto ara restar las cantidades de los productos vendidos del stock
            $productCant = Producto::findOrFail($value);

            $productCant->update(["Cantidad" => $productCant->Cantidad - $input["cantidades"][$key]]);

            if ($productCant->Cantidad == 0) {
                // $productCant->Estado = 0;
                // dd($productCant);
                $productCant->update([
                    "Estado"=>0,
                ]);
            
            }
        }

        DB::commit();

        if ($productCant->Cantidad == 0) {
            alert()->success('Venta registrada exitosamente pero  el stock de algunos productos  se encuentra en 0');
            return redirect("/ventas");
        }
        alert()->success('Venta registrada exitosamente');
        return redirect("/ventas");

        } catch (\Throwable $e) {
            DB::rollBack();
            alert()->warning('error', 'Error al registrar la venta');
            return redirect("/ventas");
        }

    }


    public function listar()
    {
        
        $ventas = Ventas::select("ventas.*", "clientes.Nombre_Cliente as NombreCliente", "users.name as NombreUsuario")
        ->join("clientes", "ventas.cliente_id", "=", "clientes.id")
        ->join("users", "ventas.usuario_id", "=", "users.id")
        ->get();
        
        
        return DataTables::of($ventas)
            ->editColumn('estado', function ($ventas) {
                return $ventas->Estado == 1 ? '<a class="cursorBtn button mb-2 bg-theme-1 text-white">Activa</a>' : '<a class="cursorBtn button mb-2 bg-theme-6 text-white">Anulada</a>';
            })
            ->editColumn('created_at', function ($ventas) {
                return $ventas->created_at->toDateString();
            })
            ->addColumn('acciones', function ($ventas) {
                $estado = '';

                if (Auth::user()->rol_id == 1) {

                    if ($ventas->Estado == 1) {
                        $estado = '<a href="/ventas/cambiarEstado/' . $ventas->id . '/0" class="btn btn-danger btn-sm text-red-600" title="Click aqui para anular esta venta"><i class="fas fa-ban"></i></a>';
                    }
                    
                }

                return '<a href="/ventas/verproductos/' . $ventas->id . '" class="btn btn-secondary btn-sm text-blue-800" title="Click aqui para ver detalle de esta venta"><i class="fas fa-eye"></i></a>' . ' ' . $estado;
            })
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }



    public function listardetalle($id) 
    {
            $venta = Ventas::select("ventas.Precio_total as precio")
            ->where("ventas.id",$id)
            ->get();
        
            $ventasdetalle = VentasDetalle::select("ventasdetalle.id", "ventasdetalle.venta_id as Ventas", "productos.Nombre_Producto as Productos", "ventasdetalle.Cantidad as Cantidad", "ventasdetalle.Precio_unitario", "ventasdetalle.Sub_total as SubTotal")
                ->join("productos", "ventasdetalle.producto_id", "=", "productos.id")
                ->where("ventasdetalle.venta_id", "=", $id)
                ->get();

                
            return view("ventas.productos", compact("ventasdetalle","venta"));

    }


    public function updateState($id, $Estado)
    {
        

        $ventas = Ventas::find($id);

        //consulta para devolver el stock de los productos
        $ventasdetalle = VentasDetalle::select("ventasdetalle.id  as Id", "productos.id as Productos", "ventasdetalle.Cantidad as Cantidad")
                ->join("productos", "ventasdetalle.producto_id", "=", "productos.id")
                ->where("ventasdetalle.venta_id", "=", $id)
                ->get();

                
        if ($Estado == 0) {

            foreach ($ventasdetalle as $value) {

                $productos = Producto::find($value->Productos);

                $productos->Estado = 1;
                
                $productos->update(["Cantidad"=> $productos->Cantidad + $value->Cantidad]);

                
            }
            
        }
    
        $ventas->update(["Estado"=>$Estado]);
        alert()->success('Venta anulada exitosamente');
        return redirect("/ventas");
    }

}