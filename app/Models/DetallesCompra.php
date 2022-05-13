<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesCompra extends Model
{
    protected $table = 'detallecompra'; 

    protected $fillable = [
        
        'producto_id', 
        'compra_id', 
        'Precio_unitario', 
        'Cantidad', 
        'Sub_total'
    ]; 


    public $timestamps = false;
}
