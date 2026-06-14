<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
use App\Models\Ejemplar;


class PrestamoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'usuario_id' => Usuario::factory(),
            'ejemplar_id' => Ejemplar::factory(),
            'fecha_prestamo' => $this->faker->date(),
            'fecha_devolucion' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['prestado', 'devuelto']),
            'registrado_por' => Usuario::factory(),
        ];
    }
}