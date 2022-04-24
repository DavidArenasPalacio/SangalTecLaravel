<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesCompra extends Model
{
    protected $table = 'detallecompra'; 

    protected $fillable = ['compra_id', 'producto_id', 'Cantidad', 'Sub_total']; 


    public $timestamps = false;
}
