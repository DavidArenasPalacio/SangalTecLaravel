<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use Alert;

class Producto extends Model
{
    protected $table = 'productos'; 
    
    protected $fillable = ['categoria_id', 'Nombre_Producto', 'Precio_Compra', 'Precio_Venta', 'Cantidad', 'Estado']; 


    public $timestamps = false;
}
