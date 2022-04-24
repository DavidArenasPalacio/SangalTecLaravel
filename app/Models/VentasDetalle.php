<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasDetalle extends Model
{
    use HasFactory;

    protected $table = "ventasdetalle";

    protected $fillable = [
        'producto_id',
        'venta_id',
        'Cantidad',
        'Sub_total'
        
    ];

    public $timestamps = false;

    
}
