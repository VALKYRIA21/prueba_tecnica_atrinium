<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;


    // Nombre de la tabla en MySQL
    protected $table='empresas';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable=[
        'direccion_empresa',
        'estado_empresa',
        'nombre_empresa',
        'telefono_empresa',
        'tipo_documento',
        'usuario_id',
    ];


    // Una empresa pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
    // Una empresa puede tener muchas actividades
    public function actividades()
    {
        return $this->hasMany(ActividadEmpresa::class);
    }
    // Una empresa puede tener un estado
    public function estado()
    {
        return $this->belongsTo(EstadoEmpresa::class);
    }
}
