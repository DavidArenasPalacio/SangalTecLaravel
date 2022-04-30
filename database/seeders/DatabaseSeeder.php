<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();        
        $this->call(RolSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ClientesSeeder::class);
        $this->call(VentasSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ComprasSeeder::class);
    }
}
