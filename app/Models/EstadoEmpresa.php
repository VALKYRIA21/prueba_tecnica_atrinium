<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoEmpresa extends Model
{
    use HasFactory;

    // Nombre de la tabla en MySQL
    protected $table='estado_empresas';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable=[
        'nombre'
    ];

    // Un estado lo puede tener muchas empresas
    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }
}
