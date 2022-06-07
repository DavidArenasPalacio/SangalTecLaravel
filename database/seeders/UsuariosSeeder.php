<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "David",
            "documento" => "113433992",
            "telefono" => "8776092",
            "direccion" => "Cr 28 #1083",
            "email" => "davidarenasp123@gmail.com",
            "password" => Hash::make("123456789"),
            "estado" => 1,
            "rol_id" => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::create([
            "name" => "Isaac",
            "documento" => "112454664",
            "telefono" => "2454467",
            "direccion" => "Cr 34 #17",
            "email" => "isaacsenatecnica123@gmail.com",
            "password" => Hash::make("123456789"),
            "estado" => 1,
            "rol_id" => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::create([
            "name" => "yeferson",
            "documento" => "2387763898",
            "telefono" => "7465542",
            "direccion" => "Cr 23 #50",
            "email" => "yefersonloaiza43@gmail.com",
            "password" => Hash::make("123456789"),
            "estado" => 1,
            "rol_id" => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        User::create([
            "name" => "julian",
            "documento" => "2387763898",
            "telefono" => "7465542",
            "direccion" => "Cr 23 #50",
            "email" => "yjloaiza1@misena.edu.co",
            "password" => Hash::make("123456789"),
            "estado" => 1,
            "rol_id" => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        User::create([
            "name" => "sebastian",
            "documento" => "12334456576",
            "telefono" => "2334567",
            "direccion" => "Cr 50 #30",
            "email" => "sebastian@gmail.com",
            "password" => Hash::make("123456789"),
            "estado" => 1,
            "rol_id" => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        
    }
}
