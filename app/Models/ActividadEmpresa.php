<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadEmpresa extends Model
{
    use HasFactory;

    // Nombre de la tabla en MySQL
    protected $table='actividad_empresas';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable=[
        'descripcion',
        'empresa_id',
        'nombre',
    ];

    // Una actividad de empresa pertenece a una empresa o varias empresas
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
