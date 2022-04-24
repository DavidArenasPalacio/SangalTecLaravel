<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\Ventas;
use App\Models\Producto;
use App\Models\Clientes;
use App\Models\VentasDetalle;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {        
        $productos = Producto::all();
        $clientes = Clientes::all();;

        return view('ventas.index', compact('productos','clientes'));

        // echo auth()->user()->id;
        // return view('ventas.index');
    }

    public function crear()
    {
        $productos = Producto::all();
        $clientes = Clientes::all();;

        return view('ventas.crear', compact('productos','clientes'));
    }

    public function store(Request $request)
    {
     
        
        
        $input = $request->all();

        //validacion para que la cantidad a vender no sea mayor al stock disponible
        foreach ($input["ProductoN"] as $key => $value) {
            $productosRecorridos = Producto::findOrFail($value);

            if ($input["cantidades"][$key] > $productosRecorridos->Cantidad) {
                return redirect('/ventas')->with('cantidad', 'El Stock De '. $productosRecorridos->Nombre_Producto .' Es Insuficiente');
            }
        } 

try {
    
    DB::beginTransaction();

    $usuarios = User::all();

        $ventas = Ventas::create([
            'cliente_id' => $input["DocumentoC"],
            'usuario_id' => auth()->user()->id,
            'Precio_total' => $input["precio_venta"],
            'Estado' => 0,
        ]);
        
        

        foreach ($input["ProductoN"] as $key => $value) {
            
            $ventasdetalle = VentasDetalle::create([

                'producto_id' => $value,
                'venta_id' => $ventas->id,
                'Cantidad' => $input["cantidades"][$key],
                'Sub_total' => $input["precios"][$key] * $input["cantidades"][$key],
            ]);

            //esto ara restar las cantidades de los productos vendidos del stock
            $productCant = Producto::findOrFail($value);

            $productCant->update(["Cantidad" => $productCant->Cantidad - $input["cantidades"][$key]]);
        }

        DB::commit();

    } catch (\Throwable $th) {
        
        return redirect("/ventas");

                DB::rollBack();  
    }

        return redirect("/ventas")->with('registrarVenta', 'Se Registro La venta Correctamente');
    }


    public function listar()
    {
        
        $ventas = Ventas::select("ventas.*", "clientes.Nombre_Cliente as NombreCliente", "users.name as NombreUsuario")
        ->join("clientes", "ventas.cliente_id", "=", "clientes.id")
        ->join("users", "ventas.usuario_id", "=", "users.id")
        ->get();
        
        
        return DataTables::of($ventas)

            ->editColumn('estado', function ($venta) {     
                return $venta->Estado == 1 ? "Activa" : "Inactiva";
            })
            

            ->addColumn('cambiar', function ($venta) {

                if ($venta->Estado == 1) {
                    return '<a class="btn btn-danger">Anulada</a>';
                }
                else{
                    return '<a class="btn btn-success" href="/ventas/cambiarEstado/'.$venta->id.'/1"> Anular</a>';
                }
            })

            ->addColumn('detalle', function ($venta) {
                return '<a href="/ventas/verproductos/'.$venta->id.'" class="btn btn-secondary"> Ver Productos Vendidos</a>';
            })
        
            ->rawColumns([ 'cambiar','detalle'])
            ->make(true);
    }



    public function listardetalle($id) 
    {
        
            $ventasdetalle = VentasDetalle::select("ventasdetalle.id", "ventasdetalle.venta_id as Ventas", "productos.Nombre_Producto as Productos", "ventasdetalle.Cantidad as Cantidad", "ventasdetalle.Sub_total as SubTotal")
                ->join("productos", "ventasdetalle.producto_id", "=", "productos.id")
                ->where("ventasdetalle.venta_id", "=", $id)
                ->get();

                
            return view("ventas.productos", compact("ventasdetalle"));

    }


    public function updateState($id, $Estado)
    {
        

        $ventas = Ventas::find($id);

        // $ventas = Ventas::select("ventas.*")
        // ->where("ventas.idVenta", "=" ,$idVenta)
        // ->first();
        //consulta para devolver el stock de los productos
        $ventasdetalle = VentasDetalle::select("ventasdetalle.id  as Id", "productos.id as Productos", "ventasdetalle.Cantidad as Cantidad")
                ->join("productos", "ventasdetalle.producto_id", "=", "productos.id")
                ->where("ventasdetalle.venta_id", "=", $id)
                ->get();

                
        if ($Estado == 1) {

            foreach ($ventasdetalle as $value) {

                $productos = Producto::find($value->Productos);

                $productos->update(["Cantidad"=> $productos->Cantidad + $value->Cantidad]);
            }
            
        }
    
        $ventas->update(["Estado"=>$Estado]);

        return redirect("/ventas")->with('cambiar', 'Se Anuló La Venta Correctamente');;
    }

}
