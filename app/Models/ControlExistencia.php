<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlExistencia extends Model
{
    use HasFactory;
    protected $table = 'controlexistencia'; 

    protected $fillable = ['producto_id', 'cantidad']; 


    public $timestamps = false;
}
