<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Clientes;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index()
    {
        
        return view('clientes.index');
    }
    
    public function crear()
    {
        return view('clientes.crear');
    }

    
    public function store(Request $request)
    {
        $input = $request->all();
        
        // $request->validate([

        //     'Nombre_Cliente' => 'required|min:3',
        //     'Documento_Cliente' => 'required|unique:clientes,Documento|numeric|digits_between:6,10',
        //     'Direccion_Cliente' => 'required|min:7|numeric|digits_between:7,12'

        // ]);

        try {

            $clientes = Clientes::create([

                'Nombre_Cliente' => $input["nombre_cliente"],
                'Documento_Cliente' => $input["documento"],
                'Telefono_Cliente' => $input["telefono_cliente"],
                'Direccion_Cliente' => $input["direccion_cliente"],

                
            ]);

        // $clientes = new Clientes();
        //     $clientes->Nombre_Cliente = $request->nombre_cliente;
        //     $clientes->Documento = $request->documento;
        //     $clientes->Telefono_Cliente = $request->telefono_cliente;
        //     $clientes->Direccion_Cliente = $request->direccion_cliente;

        //     $clientes->save();

            return redirect("/clientes")->with('registrar', 'Se Registro El Cliente Correctamente');


        } catch (\Throwable $e) {
            
            return redirect("/clientes");
        }
        
        
    }

    public function listar(Request $request)
    {
        $clientes = Clientes::all();

        return DataTables::of($clientes)

            ->addColumn('editar', function ($cliente) {
                return '<a href="/clientes/editar/'.$cliente->id.'" class="btn btn-primary"> Editar Cliente</a>';
            })

            ->addColumn('detalle', function ($cliente) {
                return '<a href="/clientes/detalle/'.$cliente->id.'" class="btn btn-secondary"> Detalle Del Cliente</a>';
            })
        
            ->rawColumns(['editar','detalle'])
            ->make(true);
    }

    public function detalle($id) 
    {
        $cliente = Clientes::find($id);

            // $cliente = Clientes::select("clientes.*")
            //     ->where("clientes.id", "=", $id)
            //     ->first();
    
            return view("clientes.detalle", compact("cliente"));

    }

    public function editar($id)
    {

        $clientes = Clientes::find($id);

        // $clientes = Clientes::where("id","=", $id)
        // ->first();

        return view('clientes.editar', compact('clientes'));
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate([

            'nombre_cliente' => 'required|min:3',
            'documento' => 'required|digits_between:6,10',
            'telefono_cliente' => 'required|min:7|numeric|digits_between:7,12'

        ]);

        // try {
            // $clientes = Clientes::select("clientes.*")
            // ->where("clientes.idCliente", "=" ,$id)
            // ->first();

            
            $clientes = Clientes::find($id);

            $clientes->Nombre_Cliente = $request->input('nombre_cliente');
            $clientes->Documento_Cliente = $request->input('documento');
            $clientes->Telefono_Cliente = $request->input('telefono_cliente');
            $clientes->Direccion_Cliente = $request->input('direccion_cliente');

            $clientes->save();

            return redirect("/clientes")->with('editar', 'Se Editó El Cliente Correctamente');

        // } catch (\Throwable $e) {
            
        //     return redirect("clientes/editar");
        // }

        
    }


    public function destroy()
    {
        //
    }
}
