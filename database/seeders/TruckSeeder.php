<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Camion;

class TruckSeeder extends Seeder
{
    public function run(): void
    {
        $camiones = [
            [
                'matricula' => '1234ABC',
                'marca' => 'Volvo',
                'modelo' => 'FH16',
                'año' => 2020,
                'nombre_propietario' => 'Transportes García S.L.',
                'telefono_propietario' => '+34 912 345 678',
                'email_propietario' => 'contacto@transportesgarcia.es',
            ],
            [
                'matricula' => '5678DEF',
                'marca' => 'Scania',
                'modelo' => 'R450',
                'año' => 2019,
                'nombre_propietario' => 'Logística Martínez',
                'telefono_propietario' => '+34 913 456 789',
                'email_propietario' => 'info@logisticamartinez.com',
            ],
            [
                'matricula' => '9012GHI',
                'marca' => 'Mercedes-Benz',
                'modelo' => 'Actros 1851',
                'año' => 2021,
                'nombre_propietario' => 'Juan Rodríguez',
                'telefono_propietario' => '+34 914 567 890',
                'email_propietario' => null,
            ],
            [
                'matricula' => '3456JKL',
                'marca' => 'MAN',
                'modelo' => 'TGX 18.480',
                'año' => 2018,
                'nombre_propietario' => 'Transportes del Norte',
                'telefono_propietario' => '+34 915 678 901',
                'email_propietario' => 'admin@transportesdelnorte.es',
            ],
            [
                'matricula' => '7890MNO',
                'marca' => 'DAF',
                'modelo' => 'XF 480',
                'año' => 2022,
                'nombre_propietario' => 'Pedro López',
                'telefono_propietario' => '+34 916 789 012',
                'email_propietario' => 'pedro.lopez@email.com',
            ],
            [
                'matricula' => '2468PQR',
                'marca' => 'Iveco',
                'modelo' => 'Stralis 460',
                'año' => 2017,
                'nombre_propietario' => 'Flota Express S.A.',
                'telefono_propietario' => '+34 917 890 123',
                'email_propietario' => 'contacto@flotaexpress.es',
            ],
            [
                'matricula' => '1357STU',
                'marca' => 'Renault',
                'modelo' => 'T High 520',
                'año' => 2020,
                'nombre_propietario' => 'Carlos Fernández',
                'telefono_propietario' => '+34 918 901 234',
                'email_propietario' => null,
            ],
            [
                'matricula' => '8642VWX',
                'marca' => 'Volvo',
                'modelo' => 'FM 420',
                'año' => 2019,
                'nombre_propietario' => 'Transportes Rápidos',
                'telefono_propietario' => '+34 919 012 345',
                'email_propietario' => 'info@transportesrapidos.com',
            ],
        ];

        foreach ($camiones as $camion) {
            Camion::create($camion);
        }
    }
}
