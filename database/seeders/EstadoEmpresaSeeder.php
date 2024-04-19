<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\EstadoEmpresa;

class EstadoEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Seeder para la tabla estado_empresa, se insertan los estados de las empresas
        EstadoEmpresa::Create([
            'nombre'=>'activo',
        ]);
        EstadoEmpresa::Create([
            'nombre'=>'inactivo',
        ]);
    }
}
