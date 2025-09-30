<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venda>
 */
class VendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
            'valor_venda' => $this->faker->numberBetween(20000, 100000),
            'status' => 0,
            'data_venda' => now(),
        ];
    }
}
