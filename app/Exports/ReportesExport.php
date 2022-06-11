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
      
            $productos= DB::table('compra')->select('compra.id','productos.Nombre_Producto', 'productos.Cantidad')
            ->join('detallecompra','compra.id','=','detallecompra.compra_id')->join('productos','detallecompra.producto_id','productos.id')->whereBetween('compra.created_at',[$this->date1,$this->date2])->get();
            
            $compra= DB::table('compra')->select('compra.id','users.name','proveedor.Nombre_proveedor','compra.Precio_total','compra.created_at')
            ->join('users','compra.usuario_id','=','users.id')
            ->join('proveedor','compra.proveedor_id','=','proveedor.id')
            ->whereBetween('compra.created_at',[$this->date1,$this->date2])->get();
    
            $productos1= DB::table('ventas')->select('ventas.id','productos.Nombre_Producto', 'productos.Cantidad')
            ->join('ventasdetalle','ventas.id','=','ventasdetalle.venta_id')->join('productos','ventasdetalle.producto_id','productos.id')->whereBetween('ventas.created_at',[$this->date1,$this->date2])->get();
            
            $ventas= DB::table('ventas')->select('ventas.id','users.name','clientes.Nombre_Cliente','ventas.Precio_total','ventas.created_at')
            ->join('users','ventas.usuario_id','=','users.id')
            ->join('clientes','ventas.cliente_id','=','clientes.id')
            ->whereBetween('ventas.created_at',[$this->date1,$this->date2])->get();
        
            return view('exports.exports', compact('compra','productos','ventas','productos1'));
            
       
        
    }
}

