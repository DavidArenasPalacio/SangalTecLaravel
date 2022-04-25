<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view("usuario.index");
    }


    public function listar()
    {
        $users = User::select("users.id", "users.name as nombre", "users.documento", "users.telefono", "users.direccion", "users.email", "users.estado", "rol.Nombre_Rol as rol")
            ->join("rol", "rol.id", "=", "users.rol_id")
            ->get();
        //  return response()->json($users);
        return DataTables::of($users)
            ->editColumn('estado', function ($users) {
                return $users->estado == 1 ? '<span class="bg-primary p-1 rounded">Activo</span>' : '<span class="bg-danger p-1 rounded">Inactivo</span>';
            })
            ->addColumn('acciones', function ($users) {
                $estado = '';

                if ($users->estado == 1) {
                    $estado = '<a href="/usuario/cambiar/estado/' . $users->id . '/0" class="btn btn-danger btn-sm"><i class="fas fa-lock"></i></a>';
                } else {
                    $estado = '<a href="/usuario/cambiar/estado/' . $users->id . '/1" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-unlock"></i></a>';
                }

                return '<a href="/usuario/editar/' . $users->id . '" class="btn btn-success btn-sm btnEstado"><i class="fas fa-edit"></i></a>' . ' ' . $estado;
            })
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }

    public function create()
    {
        $roles = Rol::all();

        return view("usuario.create", compact("roles"));
    }

    public function save(Request $request)
    {
        // $request->validate(User::$rules);

        $input = $request->all();

        try {

            User::create([
                "rol_id" => $input["rol_id"],
                "name" => $input["name"],
                "documento" => $input["documento"],
                "telefono" => $input["telefono"],
                "direccion" => $input["direccion"],
                "email" => $input["email"],
                "password" => Hash::make($input["password"]),
                "estado" => 1
            ]);

            // return dd($usuario);

            alert()->success('Usuario Creado Exitosamente');
            return redirect("/usuario");
        } catch (\Exception $e) {
            return $e;
            alert()->warning('Error', 'Error al crear Usuario');
            return redirect("/usuario/crear")->with('error', 'Error al crear usuario');;
        }
    }


    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Rol::all();
        /* return response()->json($producto[0]["idProducto"]); */

        if ($usuario == null) {

            return redirect("/usuario");
        }
        return view("usuario.edit", compact("usuario", "roles"));
    }

    public function update(Request $request)
    {

        $input = $request->all();

        try {
            $usuario = User::find($input["id"]);


            if ($usuario == null) {

                return redirect("/usuario")->with('error', 'Error al modificar usuario');
            }

            $usuario->update([
                "rol_id" => $input["rol_id"],
                "name" => $input["nombre"],
                "documento" => $input["documento"],
                "telefono" => $input["telefono"],
                "direccion" => $input["direccion"],
                "email" => $input["email"],
            ]);


            alert()->success('usuario modificado Exitosamente');
            return redirect("/usuario");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al Modificar usuario');
            return redirect("/usuario");
        }
    }

    public function updateState($id, $estado)
    {


        $user = User::where("users.id", "=", $id);

        if ($user == null) {

            return redirect("/usuario");
        }


        try {
            // example:


            $user->update(["estado" => $estado]);
            alert()->success('Estado modificado Exitosamente');
            return redirect("/usuario")->with('success', 'Estado modificado satisfactoriamente!');
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al Modificar estado');
            return redirect("/usuario")->with('error', 'Error al modifcar estado');
        }
    }
}
