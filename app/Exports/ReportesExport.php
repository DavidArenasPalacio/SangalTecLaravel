<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class ReportesExport implements FromView,ShouldAutoSize
{
    use Exportable;
    public function __construct($date1,$date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
        
    }
    public function view(): View
    {
        $productos= DB::table('compra')->select('compra.id','productos.Nombre_Producto')
        ->join('detallecompra','compra.id','=','detallecompra.compra_id')->join('productos','detallecompra.producto_id','productos.id')->whereBetween('compra.created_at',[$this->date1,$this->date2])->get();
        
        $compra= DB::table('compra')->select('compra.id','users.name','proveedor.Nombre_proveedor','compra.Precio_total','compra.created_at')
        ->join('users','compra.usuario_id','=','users.id')
        ->join('proveedor','compra.proveedor_id','=','proveedor.id')
        ->whereBetween('compra.created_at',[$this->date1,$this->date2])->get();
    
        return view('exports.exports', compact('compra','productos'));
        
    }
}

