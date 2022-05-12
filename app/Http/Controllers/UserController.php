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
                return $users->estado == 1 ? '<span class="bg-primary p-1 rounded">Habilitado</span>' : '<span class="bg-danger p-1 rounded">Deshabilitado</span>';
            })
            ->addColumn('acciones', function ($users) {
                $estado = '';


                if(Auth::user()->rol_id == 1){
                    if($users->estado == 1) {
                        $estado = '<a href="/usuario/cambiar/estado/'.$users->id.'/0" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i>';
                    }
                    else {
                        $estado = '<a href="/usuario/cambiar/estado/'.$users->id.'/1" class="btn btn-primary btn-sm btnEstado"><i class="fas fa-check-circle"></i></a>';
                    }
                }

                return '<a href="/usuario/editar/' . $users->id . '" class="btn btn-success btn-sm btnEstado"><i class="fas fa-edit"></i></a>' . ' ' . $estado;
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


            alert()->success('Usuario Registrado Exitosamente');
            return redirect("/usuario");
        } catch (\Exception $e) {
            return $e;
            alert()->warning('Error', 'Error Al Registrar Usuario');
            return redirect("/usuario/crear")->with('error', 'Error Al Registrar Usuario');
        }
    }


    public function edit($id)
    {
        // if (Auth::user()->rol_id == 1) {
            $usuario = User::find($id);

        // }
        // else{
        //     $usuario = User::select('users.*')
        //     ->where("users.id",Auth::user()->id)
        //     ->get();

        //     if ($usuario == null) {
        //         alert()->warning('Error', 'No existe el Usuario');
        //     return redirect("/usuario");
        //     }
        // }

        if ($usuario == null) {
            alert()->warning('Error', 'Error Al Editar Usuario');
            return redirect("/usuario");
        }
        $roles = Rol::all();
        
        return view("usuario.edit", compact("usuario", "roles"));
    }

    public function update(SaveUser $request)
    {

        $input = $request->all();

        try {
            $usuario = User::find($input["id"]);


            if ($usuario == null) {

                alert()->warning('Error', 'Error Al Editar Usuario');
                return redirect("/usuario");            }

            $usuario->update([
                "rol_id" => $input["rol_usuario"],
                "name" => $input["nombre_usuario"],
                "documento" => $input["documento_usuario"],
                "telefono" => $input["telefono_usuario"],
                "direccion" => $input["direccion_usuario"],
                "email" => $input["email_usuario"],
                "password" => Hash::make($input["password_usuario"]),
            ]);


            alert()->success('Usuario Editado Exitosamente');
            return redirect("/usuario");
        } catch (\Exception $e) {
            alert()->warning('Error', 'Error Al Editar Usuario');
            return redirect("/usuario");
        }
    }

    public function updateState($id, $estado)
    {
        
        $user = User::find($id);
        
        if ($user == null) {
        
            alert()->warning('Error', 'Error Al Actualizar Estado');
            return redirect("/usuario");
        }

        if ($user->rol_id != 1) {
            try {

                $user->update(["estado" => $estado]);
                alert()->success('Estado Actualizado Exitosamente');
                return redirect("/usuario");
            } catch (\Exception $e) {
                alert()->warning('Error', 'Error Al Actualizar Estado');
                return redirect("/usuario");
            }
        }
        else{
            alert()->warning('Error', 'No Se Puede Actualizar El Estado De Un Usuario Con El Rol De Administrador');
                return redirect("/usuario");
        }
    }
}
