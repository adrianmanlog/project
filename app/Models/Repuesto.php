<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    protected $table = 'repuestos';

    protected $fillable = [
        'nombre',
        'tipo',
        'marca',
        'referencia',
        'precio',
        'stock',
        'descripcion',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    public function reparaciones()
    {
        return $this->belongsToMany(Reparacion::class, 'reparacion_repuestos', 'repuesto_id', 'reparacion_id')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }
}
