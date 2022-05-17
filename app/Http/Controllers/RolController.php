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
            ->addColumn('acciones', function ($rol) {
                return '<a href="/rol/editar/' . $rol->id . '" class="btn btn-primary btn-sm"><i class="fas fa-edit""></i></a>';
            })
            ->rawColumns(['acciones'])
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
}