<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view("proveedor.index");
    }


    public function listar()
    {
        $proveedor = Proveedor::all();

        return DataTables::of($proveedor)
            ->editColumn('estado', function ($proveedor) {
                return $proveedor->Estado == 1 ? '<span class="bg-primary p-1 rounded">Activo</span>' : '<span class="bg-danger p-1 rounded">Inactivo</span>';
            })
            ->addColumn('acciones', function ($proveedor) {
                $estado = '';

                if ($proveedor->Estado == 1) {
                    $estado = '<a href="/proveedor/cambiar/estado/' . $proveedor->id . '/0" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
                } else {
                    $estado = '<a href="/proveedor/cambiar/estado/' . $proveedor->id . '/1" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
                }
                return '<a href="/proveedor/editar/'.$proveedor->id.'" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-edit"></i></a>'.' '.'<a href="/proveedor/detalle/' . $proveedor->id . '" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>' . ' ' . $estado;
            })
            
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }

    public function create(){
        return view('proveedor.create');
    }


    public function save(Request $request)
    {
        $input =  $request->all();

     

        try {

            Proveedor::create([
                "Nombre_Proveedor" => $input["Nombre_Proveedor"],
                "Correo_Proveedor" => $input["Correo_Proveedor"],
                "Telefono_Proveedor" => $input["Telefono_Proveedor"],
                "Direccion_Proveedor" => $input["Direccion_Proveedor"],
                "Estado" => 1
            ]);


            alert()->success('Proveedor creado Exitosamente');
            return redirect("/proveedor");
        } catch (\Exception $e) {
            alert()->warning('error', 'Error al crear proveedor');
            return redirect("/proveedor");
        }
    }



    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        if ($proveedor == null) {
            return redirect("/proveedor");
        }

        return  view("proveedor.edit", compact("proveedor"));
    }


    public function update(Request $request)
    {
        $input = $request->all();

        try {

            $proveedor = Proveedor::where("proveedor.id", $input["id"]);

            if ($proveedor == null) {
                return redirect("/proveedor");
            }

            $proveedor->update([
                "Nombre_Proveedor" => $input["nombre"],
                "Correo_Proveedor" => $input["correo"],
                "Telefono_Proveedor" => $input["telefono"],
                "Direccion_Proveedor" => $input["direccion"],
            ]);

            alert()->success('Proveedor modificado exitosamente');
            return redirect("/proveedor");

        } catch (\Exception $e) {
            alert()->warning('error', 'Error al modificar el proveedor');
            return redirect("/proveedor");
        }
    }

    public function detalle($id) 
    {
        $proveedor = Proveedor::find($id);
    
            return view("proveedor.detalle", compact("proveedor"));

    }

    public function updateState($id, $estado)
    {
        

        $proveedor = Proveedor::where("proveedor.id", "=", $id);

        if ($proveedor == null) {
          
            return redirect("/proveedor");
        }


        try {
            // example:


            $proveedor->update(["Estado" => $estado]);
            alert()->success('Estado modificado Exitosamente');
            return redirect("/proveedor")->with('success', 'Estado modificado satisfactoriamente!');
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al Modificar estado');
            return redirect("/proveedor")->with('error', 'Error al modifcar estado');
        }
    }

}
