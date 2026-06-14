<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Libro;
use App\Models\Usuario;

class EjemplarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'libro_id' => Libro::factory(),
            'codigo_inventario' => $this->faker->unique()->bothify('INV-###'),
            'estado' => $this->faker->randomElement(['disponible', 'prestado']),
            'registrado_por' => Usuario::factory(),
        ];
    }
}