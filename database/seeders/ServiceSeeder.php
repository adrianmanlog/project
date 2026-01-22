<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            [
                'nombre' => 'Cambio de ballestas delanteras',
                'descripcion' => 'Sustitución completa del juego de ballestas delanteras, incluye mano de obra y revisión de componentes asociados.',
                'precio_base' => 450.00,
                'horas_estimadas' => 3.5,
                'activo' => true,
            ],
            [
                'nombre' => 'Cambio de ballestas traseras',
                'descripcion' => 'Sustitución completa del juego de ballestas traseras, incluye mano de obra y revisión de componentes asociados.',
                'precio_base' => 520.00,
                'horas_estimadas' => 4.0,
                'activo' => true,
            ],
            [
                'nombre' => 'Reparación de amortiguadores',
                'descripcion' => 'Reparación o sustitución de amortiguadores defectuosos, incluye diagnóstico y prueba de funcionamiento.',
                'precio_base' => 280.00,
                'horas_estimadas' => 2.5,
                'activo' => true,
            ],
            [
                'nombre' => 'Mantenimiento completo de suspensión',
                'descripcion' => 'Revisión y mantenimiento integral del sistema de suspensión: ballestas, amortiguadores, bujes y grapas.',
                'precio_base' => 850.00,
                'horas_estimadas' => 6.0,
                'activo' => true,
            ],
            [
                'nombre' => 'Inspección de sistema de suspensión',
                'descripcion' => 'Inspección visual y funcional del sistema de suspensión completo con informe detallado.',
                'precio_base' => 120.00,
                'horas_estimadas' => 1.5,
                'activo' => true,
            ],
            [
                'nombre' => 'Cambio de grapas y bujes',
                'descripcion' => 'Sustitución de grapas y bujes desgastados en el sistema de ballestas.',
                'precio_base' => 180.00,
                'horas_estimadas' => 2.0,
                'activo' => true,
            ],
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}
