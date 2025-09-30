<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Carro;
use App\Models\Venda;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria um usuário admin fixo para testes
        $user = User::firstOrCreate(
            ['email' => 'admin@test.com'], // verifica se já existe
            [
                'name' => 'Admin Teste',
                'password' => bcrypt('123456'),
            ]
        );

        // Cria 10 clientes fake
        $clientes = Cliente::factory(10)->create([
            'usuario_id' => $user->id,

        ]);

        // Cria 10 carros fake
        $carros = Carro::factory(10)->create([
            'usuario_id' => $user->id,
            'status' => 1, // disponível
        ]);

        // Cria 5 vendas fake
        Venda::factory(5)->create([
            'usuario_id'  => $user->id,
            'cliente_id'  => $clientes->random()->id,
            'carro_id'    => $carros->random()->id,
            'status'      => 0, // fechada
            'valor_venda' => fake()->numberBetween(20000, 100000),
        ]);
    }
}
