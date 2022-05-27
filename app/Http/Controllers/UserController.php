<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Else_;
use Yajra\Datatables\Datatables; 
use App\Http\Requests\SaveUser;
use App\Http\Requests\UpdateUserEmpleado;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function index()
    {
        return view("usuario.index");
    }


    public function listar()
    {
        if(Auth::user()->rol_id == 1){

        $users = User::select("users.id", "users.name as nombre", "users.documento", "users.telefono", "users.direccion", "users.email", "users.estado", "rol.Nombre_Rol as rol")
            ->join("rol", "rol.id", "=", "users.rol_id")
            ->get();
        }
        else{
            $users = User::select("users.id", "users.name as nombre", "users.documento", "users.telefono", "users.direccion", "users.email", "users.estado", "rol.Nombre_Rol as rol")
            ->join("rol", "rol.id", "=", "users.rol_id")
            ->where("users.name", Auth::user()->name)
            ->get();
        }
            
        //  return response()->json($users);
        return DataTables::of($users)
            ->editColumn('estado', function ($users) {
                return $users->estado == 1 ? '<a class="cursorBtn button mb-2 bg-theme-1 text-white">Habilitado</a>' : '<a class="cursorBtn button mb-2 bg-theme-6 text-white">Deshabilitado</a>';
            })
            ->addColumn('acciones', function ($users) {
                $estado = '';


                if(Auth::user()->rol_id == 1){
                    if($users->estado == 1) {
                        $estado = '<a href="/usuario/cambiar/estado/'.$users->id.'/0" class="btn btn-danger btn-sm text-red-600"><i class="fas fa-ban"></i>';
                    }
                    else {
                        $estado = '<a href="/usuario/cambiar/estado/'.$users->id.'/1" class="btn btn-danger btn-sm text-green-600"><i class="fas fa-check-circle"></i></a>';
                    }

                    return '<a href="/usuario/editar/' . $users->id . '" class="btn btn-secondary btn-sm text-blue-800"><i class="fas fa-edit"></i></a>' . ' ' . $estado;
                }
                else{
                    return '<a href="/usuario/editarEmpleado/' . $users->id . '" class="btn btn-secondary btn-sm text-blue-800"><i class="fas fa-edit"></i></a>';
                }

                
            })
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }

    public function crear()
    {
        $roles = Rol::all();

        return view("usuario.crear", compact("roles"));
    }

    public function save(SaveUser $request)
    {

        $input = $request->all();

        try {

            $usuario = User::create([
                "rol_id" => $input["rol_usuario"],
                "name" => $input["nombre_usuario"],
                "documento" => $input["documento_usuario"],
                "telefono" => $input["telefono_usuario"],
                "direccion" => $input["direccion_usuario"],
                "email" => $input["email_usuario"],
                "password" => Hash::make($input["password_usuario"]),
                "estado" => 1
            ]);


            alert()->success('Usuario registrado exitosamente');
            return redirect("/usuario");
        } catch (\Exception $e) {
            return $e;
            alert()->warning('Error', 'Error al registrar usuario');
            return redirect("/usuario");
        }
    }


    public function edit($id)
    {
            $usuario = User::find($id);

        if ($usuario == null) {
            alert()->warning('Error', 'Error al editar usuario');
            return redirect("/usuario");
        }
        $roles = Rol::all();
        
        return view("usuario.edit", compact("usuario", "roles"));
    }

    public function update(UpdateUser $request)
    {

        $input = $request->all();

        try {
            $usuario = User::find($input["id"]);


            if ($usuario == null) {

                alert()->warning('Error', 'Error al editar usuario');
                return redirect("/usuario");
            }

            $usuario->update([
                "rol_id" => $input["rol_usuario"],
                "name" => $input["nombre_usuario"],
                "documento" => $input["documento_usuario"],
                "telefono" => $input["telefono_usuario"],
                "direccion" => $input["direccion_usuario"],
                "email" => $input["email_usuario"],
                "password" => Hash::make($input["password_usuario"]),
            ]);


            alert()->success('Usuario editado exitosamente');
            return redirect("/usuario");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al editar usuario');
            return redirect("/usuario");
        }
    }

    //EDITAR DEL EMPLEADO
    public function editEmpl($id)
    {

        $usuario = User::Find($id);

        if (Auth::user()->id == $id) {

            if ($usuario == null) {
                alert()->warning('Error', 'Error al editar usuario');
                return redirect("/usuario");
            }
            
            return view("usuario.editEmpl", compact("usuario"));
        }
        
          alert()->warning('Error', 'No puedes editar este usuario');
         return redirect("/usuario");

    }

    public function updateEmpl(UpdateUserEmpleado $request)
    {

        $input = $request->all();

        try {
            $usuario = User::find($input["id"]);


            if ($usuario == null) {

                alert()->warning('Error', 'Error al editar usuario');
                return redirect("/usuario");
            }

            $usuario->update([
                "telefono" => $input["telefono_usuario"],
                "direccion" => $input["direccion_usuario"],
                "email" => $input["email_usuario"],
                "password" => Hash::make($input["password_usuario"]),
            ]);


            alert()->success('Usuario editado exitosamente');
            return redirect("/usuario");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error al editar usuario');
            return redirect("/usuario");
        }
    }


    public function updateState($id, $estado)
    {
        
        $user = User::find($id);
        
        if ($user == null) {
        
            alert()->warning('Error', 'Error al actualizar estado');
            return redirect("/usuario");
        }

        if ($user->rol_id != 1) {
            try {

                $user->update(["estado" => $estado]);
                alert()->success('Estado actualizado exitosamente');
                return redirect("/usuario");
            } catch (\Exception $e) {
                alert()->warning('Error', 'Error al actualizar estado');
            return redirect("/usuario");
            }
        }
        else{
            alert()->warning('Error', 'No se puede actualizar el estado de un usuario con el rol de administrador');
                return redirect("/usuario");
        }
    }
}