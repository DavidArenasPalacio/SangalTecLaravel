<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\ControlExistencia;
use Yajra\Datatables\Datatables; 
use Illuminate\Http\Request;

class ControlExistenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        return view("controlExistencia.index");
    }  


    public function listar(){
        $controlExistencia = ControlExistencia::select("controlexistencia.*", "producto.nombre as producto")
        ->join("producto", "producto.idProducto", "=", "controlexistencia.producto_id")
        ->get();
        return DataTables::of($controlExistencia)
        ->make(true);
    }

}
