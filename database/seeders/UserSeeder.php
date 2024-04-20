<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'nombre_usuario' => 'Admin',
            'email_usuario' => 'admin@test.com',
            'telefono_usuario' => '1234567890',
            // Rol de administrador
            'rol_id' => 1,
        ]);
    }
}
