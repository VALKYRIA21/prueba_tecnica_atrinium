<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialConversion extends Model
{

    use HasFactory;

    // Nombre de la tabla en MySQL
    protected $table='historial_conversions';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable=[
        'moneda_origen',
        'moneda_destino',
        'monto_origen',
        'monto_destino',
        'monto_final',
    ];
}
