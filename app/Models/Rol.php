<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'rol';


    protected $fillable = ['Nombre_Rol','Estado'];


    public static $rules = [ 
        'Nombre_Rol' => 'required|min:5',
    ];

    public $timestamps = false;
}
