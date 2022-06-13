<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proveedor::create([
            "Nombre_Proveedor" => "Norma",
            "Correo_Proveedor" => "norma@norma.com",
            "Telefono_Proveedor" => "3467537",
            "Direccion_Proveedor" => "cr 334 #23",
            "Estado" => 1
        ]);

        Proveedor::create([
            "Nombre_Proveedor" => "Distrimax",
            "Correo_Proveedor" => "Distrimax@max.com",
            "Telefono_Proveedor" => "34556732",
            "Direccion_Proveedor" => "cr 24 #3",
            "Estado" => 1
        ]);

        Proveedor::create([
            "Nombre_Proveedor" => "Samsumg",
            "Correo_Proveedor" => "Samsumg@ss.com",
            "Telefono_Proveedor" => "2345562",
            "Direccion_Proveedor" => "cr 45 #2",
            "Estado" => 1
        ]);
    }
}
