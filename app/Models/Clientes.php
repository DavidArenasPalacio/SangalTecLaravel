<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $fillable = [
        
        'Nombre_Cliente',
        'Documento_Cliente',
        'Telefono_Cliente',
        'Direccion_Cliente',
    ];

    public $timestamps = false;

}
