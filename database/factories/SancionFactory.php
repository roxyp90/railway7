<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SancionFactory extends Factory
{
    public function definition(): array
    {
        return [
        'usuario_id' => \App\Models\Usuario::inRandomOrder()->first()->id,
        'prestamo_id' => \App\Models\Prestamo::inRandomOrder()->first()->id,
        'dias_retraso' => $this->faker->numberBetween(1, 30),
        'motivo' => $this->faker->randomElement(['retraso', 'daño', 'perdida']),
        'multa' => $this->faker->randomFloat(2, 1000, 20000),
        'fecha_sancion' => $this->faker->date(),
        'estado' => $this->faker->randomElement(['pendiente', 'pagada']),
        'registrado_por' => \App\Models\Usuario::inRandomOrder()->first()->id,
     ];
    }
}