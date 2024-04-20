<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    use HasFactory;

    // Nombre de la tabla en MySQL
    protected $table='rol_usuarios';

    // Atributos que se pueden asignar de manera masiva.
    protected $fillable=[
        'nombre'
    ];

    // Un rol lo puede tener muchos usuarios
    public function usuarios()
    {
        return $this->hasMany(User::class, 'rol_id');
    }
}
