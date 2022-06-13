<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            "Nombre_Rol" => "Administrador",
            "Estado" => 1
        ]);

        Rol::create([
            "Nombre_Rol" => "Empleado",
            "Estado" => 1
        ]);
    }
}
