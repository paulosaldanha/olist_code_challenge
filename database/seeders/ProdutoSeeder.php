<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produto = \App\Models\Produto::factory()
        ->count(1)
        ->create([
            'name' => 'Sabão em Po',
            'quantity' => '2',
            'tipo_produto_id' => '1',
        ]);

    $produto = \App\Models\Produto::factory()
        ->count(1)
        ->create([
            'name' => 'Sabão Liquido',
            'quantity' => '5',
            'tipo_produto_id' => '1',
        ]);
    }
}
