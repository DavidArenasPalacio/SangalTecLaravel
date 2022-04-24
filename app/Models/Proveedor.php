<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor'; 
    
    protected $fillable = ['Nombre_Proveedor', 'Correo_Proveedor', 'Telefono_Proveedor', 'Direccion_Proveedor', 'Estado'];
    
    public $timestamps = false;
}
