<?php

namespace App\Http\Controllers;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Clientes;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveCliente;
use App\Http\Requests\UpdateClientes;

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

    
    public function store(SaveCliente $request)
    {
        $input = $request->all();

        try {

            $clientes = Clientes::create([

                'Nombre_Cliente' => $input["nombre"],
                'Documento_Cliente' => $input["documento"],
                'Telefono_Cliente' => $input["telefono"],
                'Direccion_Cliente' => $input["direccion"],

                
            ]);

            alert()->success('Cliente registrado exitosamente');
            return redirect("/clientes");

        } catch (\Throwable $e) {
            
            alert()->warning('error', 'Error al registrar el cliente');
            return redirect("/clientes");
        }
        
        
    }

    public function listar(Request $request)
    {
        $clientes = Clientes::all();

        return DataTables::of($clientes)

            ->addColumn('acciones', function ($clientes) {
                return '<a href="/clientes/editar/'.$clientes->id.'" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-edit"></i></a>'.' '.'<a href="/clientes/detalle/' . $clientes->id . '" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>';
            })
            
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function detalle($id) 
    {
        $cliente = Clientes::find($id);

            return view("clientes.detalle", compact("cliente"));

    }

    public function editar($id)
    {
        $clientes = Clientes::find($id);

        return view('clientes.editar', compact('clientes'));
    }


    public function update(UpdateClientes $request, $id)
    {
        // $input = $request->all();

        try {
            
            $clientes = Clientes::find($id);

            $clientes->Nombre_Cliente = $request->input('nombre');
            $clientes->Documento_Cliente = $request->input('documento');
            $clientes->Telefono_Cliente = $request->input('telefono');
            $clientes->Direccion_Cliente = $request->input('direccion');

            $clientes->save();

            alert()->success('Cliente editado exitosamente');
            return redirect("/clientes");

        } catch (\Throwable $e) {
            
            alert()->warning('error', 'Error al editar el cliente');
            return redirect("/clientes");
        }

        
    }
}
