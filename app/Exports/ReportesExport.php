<?php

namespace App\Exports;

use App\Models\Compra;
use App\Models\Ventas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportesExport implements FromView
{

    public function __construct($date1,$date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
        
    }
    public function view(): View
    {
        $ventas=Ventas::all();
        $compra=Compra::all();
        return view('exports.exports', compact('ventas','compra'));
        
    }
}

