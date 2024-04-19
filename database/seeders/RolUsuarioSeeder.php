<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\RolUsuario;

class RolUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Seeder para la tabla rol_users, se insertan los roles de los usuarios
        RolUsuario::Create([
            'nombre'=>'admin',
        ]);
        RolUsuario::Create([
            'nombre'=>'basic_user',
        ]);
    }
}
