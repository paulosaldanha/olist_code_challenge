<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        return response()->json([
            "success" => true,
            "message" => "Listagem de Produto",
            "data" => $produtos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdutoRequest $request)
    {
        $inputs = $request->all();

        $produtos = Produto::create($inputs);
        return response()->json([
            "success" => true,
            "message" => "Tipo Produto criado com sucesso.",
            "data" => $produtos
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        if(is_null($produto)){
            return $this->sendError("Produto não encontrado");
        }
        return response()->json([
            "success" => true,
            "message" => "Produto recuperado com sucesso.",
            "data" => $produto
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Produto   $produto
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProdutoRequest $request, Produto $produto)
    {
        $inputs = $request->all();
        $produto->name = $inputs['name'];
        $produto->quantity += $inputs['quantity'];
        $produto->tipo_produto_id = $inputs['tipo_produto_id'];
        $produto->save();

        return response()->json([
            "success" => true,
            "message" => "Produto atualizado com sucesso.",
            "data" => $produto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Produto   $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return response()->json([
            "success" => true,
            "message" => "Produto deletado com sucesso.",
            "data" => $produto
        ]);
    }

    /**
     *  TO DO improve this code for a better way
     */
    public function updateFromArray(Request $request)
    {
        $produtos = $request->all();

        foreach ($produtos as $produto){
            $validade = $request->validate();
            $produtosRecovery = Produto::where('name', $produto['name'])->first();
            if($produtosRecovery){
                $quantity = $produtosRecovery->quantity + $produto['quantity'];
                $produtosRecovery->update(['quantity' => $quantity]);
            }

        }
        $produtos = Produto::all();

        return response()->json([
            "success" => true,
            "message" => "Lista de produtos atualizados.",
            "data" => $produtos
        ]);

    }
}
