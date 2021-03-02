<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TipoProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo_produto = \App\Models\TipoProduto::factory()
        ->count(1)
        ->create([
            'name' => 'Produto de limpeza',
        ]);

    $tipo_produto = \App\Models\TipoProduto::factory()
        ->count(1)
        ->create([
            'name' => 'Alimentação',
        ]);
    }
}
