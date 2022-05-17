<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\SaveProveedor;

class ProveedorController extends Controller
{
    public function index()
    {
        return view("proveedor.index");
    }


    public function listar()
    {
        $proveedor = Proveedor::all();

        return DataTables::of($proveedor)
            ->editColumn('estado', function ($proveedor) {
                return $proveedor->Estado == 1 ? '<a class="btn btn-success">Habilitado</a>' : '<a class="btn btn-danger">Deshabilitado</a>';
            })
            ->addColumn('acciones', function ($proveedor) {
                $estado = '';

                if ($proveedor->Estado == 1) {
                    $estado = '<a href="/proveedor/cambiar/estado/' . $proveedor->id . '/0" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i></a>';
                } else {
                    $estado = '<a href="/proveedor/cambiar/estado/' . $proveedor->id . '/1" class="btn btn-success btn-sm"><i class="fas fa-check-circle"></i></a>';
                }
                return '<a href="/proveedor/editar/'.$proveedor->id.'" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-edit"></i></a>'.' '.'<a href="/proveedor/detalle/' . $proveedor->id . '" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>' . ' ' . $estado;
            })
            
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }

    public function crear()
    {
        return view('proveedor.crear');
    }


    public function save(SaveProveedor $request)
    {
        $input =  $request->all();

    

        try {

            Proveedor::create([
                "Nombre_Proveedor" => $input["nombre"],
                "Correo_Proveedor" => $input["correo"],
                "Telefono_Proveedor" => $input["telefono"],
                "Direccion_Proveedor" => $input["direccion"],
                "Estado" => 1
            ]);


            alert()->success('Proveedor registrado exitosamente');
            return redirect("/proveedor");
        } catch (\Exception $e) {
            alert()->warning('error', 'Error al registrar eL proveedor');
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


    public function update(SaveProveedor $request, $id)
    {
        $input = $request->all();

        try {

            $proveedor = Proveedor::find($id);

            if ($proveedor == null) {
                alert()->warning('error', 'Error al editar eL proveedor');
                return redirect("/proveedor");
            }

            $proveedor->update([
                "Nombre_Proveedor" => $input["nombre"],
                "Correo_Proveedor" => $input["correo"],
                "Telefono_Proveedor" => $input["telefono"],
                "Direccion_Proveedor" => $input["direccion"],
            ]);

            alert()->success('Proveedor editado exitosamente');
            return redirect("/proveedor");

        } catch (\Exception $e) {
            alert()->warning('error', 'Error al editar eL proveedor');
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
        
            alert()->warning('Error', 'Error al actualizar estado');
            return redirect("/proveedor");
        }


        try {

            $proveedor->update(["Estado" => $estado]);
            alert()->success('Estado actualizado exitosamente');
            return redirect("/proveedor");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al actualizar estado');
            return redirect("/proveedor");
        }
    }

}
