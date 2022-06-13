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
            "Direccion_Cliente" => "xxxxxxxxxx"
        ]);

    }
}
