<?php

namespace Database\Seeders;

use App\Models\Ventas;
use App\Models\VentasDetalle;
use Illuminate\Database\Seeder;

class VentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ventas::create([
            "cliente_id" => 1,
            "usuario_id" => 1,
            "Precio_total" => 15000,
            "Estado" => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        VentasDetalle::create([
            "venta_id" => 1,
            "producto_id" => 1,
            "Cantidad" => 3,
            "Sub_total" => 45000,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        Ventas::create([
            "cliente_id" => 2,
            "usuario_id" => 2,
            "Precio_total" => 20000,
            "Estado" => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        VentasDetalle::create([
            "venta_id" => 1,
            "producto_id" => 1,
            "Cantidad" => 4,
            "Sub_total" => 80000,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
