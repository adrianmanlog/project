<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders para la API de reparación de camiones
        $this->call([
            ServicioSeeder::class,
            RepuestoSeeder::class,
            CamionSeeder::class,
        ]);
    }
}
