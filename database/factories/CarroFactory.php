<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarroFactory extends Factory
{
    public function definition()
    {
        // Arrays de marcas e modelos
        $marcasModelos = [
            'Toyota' => ['Corolla', 'Hilux', 'Yaris'],
            'Ford' => ['Fiesta', 'Focus', 'Ranger'],
            'Chevrolet' => ['Onix', 'S10', 'Cruze'],
            'Volkswagen' => ['Gol', 'Polo', 'T-Cross']
        ];

        $cores = ['Preto', 'Branco', 'Prata', 'Azul', 'Vermelho', 'Cinza'];

        // Escolher aleatoriamente marca e modelo correspondente
        $marca = $this->faker->randomElement(array_keys($marcasModelos));
        $modelo = $this->faker->randomElement($marcasModelos[$marca]);

        return [
            'marca' => $marca,
            'modelo' => $modelo,
            'ano' => $this->faker->numberBetween(2000, 2025),
            'cor' => $this->faker->randomElement($cores),
            'preco' => $this->faker->randomFloat(2, 20000, 200000),
            'status' => 0, // todos disponíveis inicialmente
        ];
    }
}
