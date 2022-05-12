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
            "Precio_total" => 76000,
            "Estado" => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        VentasDetalle::create([
            "venta_id" => 1,
            "producto_id" => 3,
            "Precio_unitario" => 30000,
            "Cantidad" => 2,
            "Sub_total" => 60000,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        VentasDetalle::create([
            "venta_id" => 1,
            "producto_id" => 1,
            "Precio_unitario" => 8000,
            "Cantidad" => 2,
            "Sub_total" => 16000,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
