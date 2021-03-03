<?php

namespace Tests\Feature;

use App\Models\Produto;
use App\Models\TipoProduto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    public function test_it_should_save()
    {
        $produto = Produto::factory()
                    ->for(TipoProduto::factory()->state([
                        'name' => 'Limpeza',
                    ]))
                    ->make();
        $payload = [
            'name' => $produto->name,
            'quantity' => $produto->quantity,
            'tipo_produto_id' => $produto->tipoProduto->id
        ];
        $this->json('POST','api/produtos',$payload,['Accept' => 'application/json'])
            ->assertStatus(201);
    }

    public function test_it_should_show()
    {
        $produto = Produto::factory()
        ->for(TipoProduto::factory()->state([
            'name' => 'Limpeza',
        ]))
        ->make();

        $this->json('GET','api/produtos/'.$produto->id,[],['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_it_should_get_all()
    {
        $produto = Produto::factory()
                    ->for(TipoProduto::factory()->state([
                        'name' => 'Limpeza',
                    ]))
                    ->make();
        $this->json('GET','api/produtos',[],['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_it_should_update()
    {
        $produto = Produto::factory()
                    ->for(TipoProduto::factory()->state([
                        'name' => 'Limpeza',
                    ]))
                    ->create();
        $payload = [
            'name' => 'Teste',
            'quantity' => '20',
            'tipo_produto_id' => '1'
        ];

        $this->json('PUT','api/produtos/'.$produto->id,$payload,['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_it_should_delete()
    {
        $produto = Produto::factory()
                    ->for(TipoProduto::factory()->state([
                        'name' => 'Limpeza',
                    ]))
                    ->create();

        $this->json('DELETE','api/produtos/'.$produto->id,[],['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_it_should_update_from_array()
    {
        $produtos = Produto::factory()
                    ->count(2)
                    ->create();

        $payload = array(
            array(
                'name' => $produtos[0]->name,
                'quantity' => '20',
            ),
            array(
                'name' => $produtos[0]->name,
                'quantity' => '5',
            ),
            array(
                'name' => $produtos[1]->name,
                'quantity' => '32',
            ),
            array(
                'name' => $produtos[1]->name,
                'quantity' => '8',
            )
        );

        $this->json('POST','api/produtos/update-array',$payload,['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
