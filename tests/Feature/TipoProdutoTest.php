<?php

namespace Tests\Feature;

use App\Models\TipoProduto;
use Database\Factories\TipoProdutoFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class TipoProdutoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_save()
    {
        $tipoProdutoData = ["name" => "Teste"];
        $this->json('POST','api/tipo-produtos',$tipoProdutoData,['Accept' => 'application/json'])
            ->assertStatus(201);
    }

    public function test_it_should_show()
    {
        $tipoProduto = TipoProduto::factory()->make();

        $this->json('GET','api/tipo-produtos/'.$tipoProduto->id,[],['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_it_should_get_all()
    {
        $tipoProduto = TipoProduto::factory()->make();
        $this->json('GET','api/tipo-produtos',[],['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_it_should_update()
    {
        $tipoProduto = TipoProduto::factory()->create();
        $payload = [
            'name' => 'Teste',
        ];
        $this->json('PUT','api/tipo-produtos/'.$tipoProduto->id,$payload,['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_it_should_delete()
    {
        $tipoProduto = TipoProduto::factory()->create();

        $this->json('DELETE','api/tipo-produtos/'.$tipoProduto->id,[],['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
