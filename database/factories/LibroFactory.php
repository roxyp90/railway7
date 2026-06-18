<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;

class LibroFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(3),
            'autor' => $this->faker->name(),
            'editorial' => $this->faker->company(),
            'anio' => $this->faker->year(),
            'estado' => 'disponible',
            'imagen' => 'uploads/libros/descargar.jpeg',
            'registrado_por' => Usuario::inRandomOrder()->first()->id ?? 1,
        ];
    }
}
