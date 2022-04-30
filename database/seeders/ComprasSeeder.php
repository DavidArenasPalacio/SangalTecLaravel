<?php

namespace Database\Seeders;

use App\Models\Compra;
use App\Models\DetallesCompra;
use Illuminate\Database\Seeder;

class ComprasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compra::create([
            "usuario_id" => 3,
            "proveedor_id" => 2,
            "Precio_total" => 15000,
            "Estado" => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DetallesCompra::create([
            "compra_id" => 1,
            "producto_id" => 1,
            "Cantidad" => 3,
            "Sub_total" => 45000,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        

    }
}
