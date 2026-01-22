<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    protected $table = 'reparaciones';

    protected $fillable = [
        'camion_id',
        'servicio_id',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'costo_total',
        'notas',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'costo_total' => 'decimal:2',
    ];

    public function camion()
    {
        return $this->belongsTo(Camion::class, 'camion_id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }

    public function repuestos()
    {
        return $this->belongsToMany(Repuesto::class, 'reparacion_repuestos', 'reparacion_id', 'repuesto_id')
            ->withPivot('cantidad', 'precio_unitario')
            ->withTimestamps();
    }
}
