<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use Yajra\Datatables\Datatables;
use App\Http\Requests\SaveRol;

class RolController extends Controller
{

    public function index()
    {
        return view("rol.index");
    }

    public function listar()
    {
        $rol = Rol::all();

        return DataTables::of($rol)

            ->editColumn('estado', function($rol){
                return $rol->Estado == 1 ? '<a class="cursorBtn button mb-2 bg-theme-1 text-white">Activo</a>' : '<a class="cursorBtn button mb-2 bg-theme-6 text-white">Inactivo</a>';
            })
            ->addColumn('acciones', function ($rol) {
                $estado = '';

                if($rol->Estado == 1) {
                    $estado = '<a href="/rol/cambiar/estado/'.$rol->id.'/0" class="btn btn-danger btn-sm text-red-600"><i class="fas fa-ban"></i></a>';
                    
                }
                else {
                    $estado = '<a href="/rol/cambiar/estado/'.$rol->id.'/1" class="btn btn-danger btn-sm text-green-600"><i class="fas fa-check-circle"></i></a>';
                }

                return '<a href="/rol/editar/' . $rol->id . '" class="btn btn-secondary btn-sm text-blue-800"><i class="fas fa-edit""></i></a>'.' '.$estado; 
            })
            ->rawColumns(['acciones','estado'])
            ->make(true);
    }

    public function crear()
    {

        return view('rol.crear');
    }

    public function save(SaveRol $request)
    {

        $input = $request->all();

        try {

            $rol = Rol::create([
                "Nombre_Rol" => $input["nombre"],
                "Estado" => 1
            ]);


            alert()->success('Rol registrado exitosamente');
            return redirect("/rol");
        } catch (\exception $e) {
            alert()->warning('Error', 'Error al registrar el rol');
            return redirect("/rol");
        }
    }


    public function edit($id)
    {
        $rol = Rol::find($id);

        if ($rol == null) {

            return redirect("/rol");
        }
        return view("rol.edit", compact("rol"));
    }

    public function update(SaveRol $request)
    {

        //$request->validate(Rol::$rules);

        $input = $request->all();



        try {
            $rol = Rol::where("rol.id", "=", $input["id"]);

            if ($rol == null) {

                alert()->warning('Error', 'Error al editar el rol');
                return redirect("/rol");
            }

            $rol->update([
                "Nombre_Rol" => $input["nombre"],
            ]);

            alert()->success('Rol editado exitosamente');
            return redirect("/rol");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al editar el rol');
            return redirect("/rol");
        }
    }

    public function updateState($id, $estado)
    {
        

        $rol = Rol::findOrFail($id);

        
        if ($rol == null) {
        
            alert()->warning('Error', 'Error al actualizar estado');
            return redirect("/rol");
        }


        if ($id != 1) {
            
            try {

                $rol->update(["Estado" => $estado]);

                alert()->success('Estado actualizado exitosamente');
                    return redirect("/rol");

            } catch (\Exception $e) {

                alert()->warning('Error', 'Error al actualizar estado');
                return redirect("/rol");
            }
        }
        else{
            alert()->warning('Error', 'No se puede actualizar el estado del rol administrador');
                return redirect("/rol");
        }
    }
}