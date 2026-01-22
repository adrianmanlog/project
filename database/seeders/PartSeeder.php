<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Repuesto;

class PartSeeder extends Seeder
{
    public function run(): void
    {
        $repuestos = [
            // Ballestas
            [
                'nombre' => 'Ballesta delantera Volvo FH',
                'tipo' => 'ballesta',
                'marca' => 'Volvo Original',
                'referencia' => 'VLV-BF-001',
                'precio' => 320.00,
                'stock' => 8,
                'descripcion' => 'Ballesta delantera original para Volvo FH, incluye pernos y casquillos.',
            ],
            [
                'nombre' => 'Ballesta trasera Scania R-Series',
                'tipo' => 'ballesta',
                'marca' => 'Scania',
                'referencia' => 'SCN-BT-450',
                'precio' => 385.00,
                'stock' => 6,
                'descripcion' => 'Ballesta trasera reforzada para Scania Serie R, capacidad de carga pesada.',
            ],
            [
                'nombre' => 'Ballesta Mercedes Actros',
                'tipo' => 'ballesta',
                'marca' => 'Mercedes-Benz',
                'referencia' => 'MB-ACT-BF',
                'precio' => 410.00,
                'stock' => 5,
                'descripcion' => 'Ballesta delantera para Mercedes Actros, alta resistencia.',
            ],
            [
                'nombre' => 'Ballesta MAN TGX',
                'tipo' => 'ballesta',
                'marca' => 'MAN',
                'referencia' => 'MAN-TGX-B01',
                'precio' => 365.00,
                'stock' => 4,
                'descripcion' => 'Ballesta trasera para MAN TGX, diseño reforzado.',
            ],
            
            // Amortiguadores
            [
                'nombre' => 'Amortiguador delantero Volvo FM',
                'tipo' => 'amortiguador',
                'marca' => 'Sachs',
                'referencia' => 'SACHS-VLV-FM',
                'precio' => 145.00,
                'stock' => 12,
                'descripcion' => 'Amortiguador telescópico de gas para eje delantero Volvo FM.',
            ],
            [
                'nombre' => 'Amortiguador trasero Scania',
                'tipo' => 'amortiguador',
                'marca' => 'Monroe',
                'referencia' => 'MNR-SCN-R',
                'precio' => 165.00,
                'stock' => 10,
                'descripcion' => 'Amortiguador hidráulico para eje trasero Scania, alta durabilidad.',
            ],
            [
                'nombre' => 'Amortiguador Mercedes Atego',
                'tipo' => 'amortiguador',
                'marca' => 'Bilstein',
                'referencia' => 'BIL-MB-ATG',
                'precio' => 175.00,
                'stock' => 8,
                'descripcion' => 'Amortiguador de gas Bilstein para Mercedes Atego.',
            ],
            [
                'nombre' => 'Amortiguador DAF XF',
                'tipo' => 'amortiguador',
                'marca' => 'Koni',
                'referencia' => 'KONI-DAF-XF',
                'precio' => 155.00,
                'stock' => 7,
                'descripcion' => 'Amortiguador premium Koni para DAF XF.',
            ],
            
            // Otros componentes
            [
                'nombre' => 'Kit de grapas y bujes',
                'tipo' => 'otro',
                'marca' => 'Universal',
                'referencia' => 'UNI-KIT-GB',
                'precio' => 45.00,
                'stock' => 20,
                'descripcion' => 'Kit completo de grapas y bujes para ballestas, compatible con múltiples marcas.',
            ],
            [
                'nombre' => 'Perno central ballesta',
                'tipo' => 'otro',
                'marca' => 'Universal',
                'referencia' => 'UNI-PC-001',
                'precio' => 18.00,
                'stock' => 30,
                'descripcion' => 'Perno central reforzado para ballestas, acero templado.',
            ],
            [
                'nombre' => 'Casquillo silentblock',
                'tipo' => 'otro',
                'marca' => 'Lemförder',
                'referencia' => 'LEM-SB-001',
                'precio' => 25.00,
                'stock' => 25,
                'descripcion' => 'Casquillo silentblock de poliuretano para suspensión.',
            ],
        ];

        foreach ($repuestos as $repuesto) {
            Repuesto::create($repuesto);
        }
    }
}
