<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Libro;
use App\Models\Ejemplar;
use App\Models\Prestamo;
use App\Models\Sancion;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Usuario::factory(10)->create();
        Libro::factory(10)->create()->each(function ($libro) {
            $libro->update(['registrado_por' => User::inRandomOrder()->first()->id]);
        });
        Ejemplar::factory(10)->create();
        Prestamo::factory(10)->create();
        Sancion::factory(10)->create();
    }
}
