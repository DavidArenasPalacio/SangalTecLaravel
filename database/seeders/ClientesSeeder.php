<?php

namespace Database\Seeders;

use App\Models\Clientes;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clientes::create([
            "Nombre_Cliente" => "Cliente único",
            "Documento_Cliente" => "xxxxxxxxxxx",
            "Telefono_Cliente" => "xxxxxxxxx",
            "Direccion_Cliente" => "xxxxxxxxxx",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);


        Clientes::create([
            "Nombre_Cliente" => "Juan",
            "Documento_Cliente" => "23434567",
            "Telefono_Cliente" => "24467654",
            "Direccion_Cliente" => "CR 490",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        Clientes::create([
            "Nombre_Cliente" => "Esteban",
            "Documento_Cliente" => "2335566",
            "Telefono_Cliente" => "566743",
            "Direccion_Cliente" => "CR #34",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
