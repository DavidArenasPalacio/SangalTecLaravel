<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ReportesExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function filtrar(Request $request){

        if ($request["fechainicio"] == null || $request["fechafin"] == null) {
            alert("Error", "Los campos de las fechas no pueden estar vacias");
            return back();
        }
    
        elseif($request["fechainicio"] <= now() && $request["fechafin"] <= now()){
            return Excel::download(new ReportesExport($request->fechainicio, $request->fechafin), 'reporte.xlsx');
        }else {
            alert("Error", "Las fechas ingresadas no pueden ser mayor al actual");
            return back();
        }

    }
    public function index(){
        $ventasChart = Ventas::select(DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count');

                    
        $ventasMonths = Ventas::select(DB::raw('Month(created_at) as month'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('month');
        
            
        $ventasData = array(0, 0, 0, 0, 0,0,0,0,0,0,0,0);
        foreach ($ventasMonths as $index => $month) {
            $ventasData[$month - 1] = $ventasChart[$index];

        }
    
        


        $comprasChart = Compra::select(DB::raw('COUNT(*) as count'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        ->pluck('count');
    
    $comprasMonths = Compra::select(DB::raw('Month(created_at) as month'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        ->pluck('month');
        
    $comprasData = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
    foreach ($comprasMonths as $index => $month) {
        $comprasData[$month - 1] = $comprasChart[$index];

    }
   
    return view('dashboard.index', compact('ventasData','comprasData'));


        
    }
}
