<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_base',
        'horas_estimadas',
        'activo',
    ];

    protected $casts = [
        'precio_base' => 'decimal:2',
        'horas_estimadas' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function reparaciones()
    {
        return $this->hasMany(Reparacion::class, 'servicio_id');
    }

    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }
}
