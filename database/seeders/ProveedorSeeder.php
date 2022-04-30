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
            "Nombre_Proveedor" => "Claro",
            "Correo_Proveedor" => "claro@claro.com",
            "Telefono_Proveedor" => "3467537",
            "Direccion_Proveedor" => "cr 334 #23",
            "Estado" => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        Proveedor::create([
            "Nombre_Proveedor" => "Tigo",
            "Correo_Proveedor" => "tigo@tigo.com",
            "Telefono_Proveedor" => "34556732",
            "Direccion_Proveedor" => "cr 24 #3",
            "Estado" => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        Proveedor::create([
            "Nombre_Proveedor" => "Movistar",
            "Correo_Proveedor" => "movistar@movistar.com",
            "Telefono_Proveedor" => "2345562",
            "Direccion_Proveedor" => "cr 45 #2",
            "Estado" => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
