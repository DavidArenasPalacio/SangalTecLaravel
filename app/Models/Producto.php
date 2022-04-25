<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use Alert;

class Producto extends Model
{
    protected $table = 'productos'; 
    
    protected $fillable = ['categoria_id', 'Nombre_Producto', 'Precio', 'Cantidad', 'Estado']; 
    
    public static $rules = [ 
        'categoria_id' =>  'required|exists:categoria,id',
        'Nombre_Producto'  => 'required|min:2',
        'Cantidad' => 'required|numeric|min:0',
        'Precio' => 'required',
        'Estado' => 'in:1,0'
    ];


    public $timestamps = false;
}
