<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camion extends Model
{
    protected $table = 'camiones';

    protected $fillable = [
        'matricula',
        'marca',
        'modelo',
        'año',
        'nombre_propietario',
        'telefono_propietario',
        'email_propietario',
    ];

    public function reparaciones()
    {
        return $this->hasMany(Reparacion::class, 'camion_id');
    }
}
