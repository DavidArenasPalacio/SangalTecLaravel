<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categoria';


    protected $fillable = ['Nombre_Categoria'];


    public static $rules = [ 
        'Nombre_Categoria' => 'required',
    ];

    public $timestamps = false;
}