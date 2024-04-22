<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyImportCommand extends Model
{
    use HasFactory;

    protected $fillable = ['moneda', 'rate', 'fecha'];

     // Nombre de la tabla en MySQL
     protected $table='currency_import_commands';
}
