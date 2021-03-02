<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoProdutoRequest;
use App\Models\TipoProduto;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoProdutos = TipoProduto::all();
        return response()->json([
            "success" => true,
            "message" => "Listagem de Tipo Produto",
            "data" => $tipoProdutos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoProdutoRequest $request)
    {
        $inputs = $request->all();
        $tipoProdutos = TipoProduto::create($inputs);
        return response()->json([
            "success" => true,
            "message" => "Tipo Produto criado com sucesso.",
            "data" => $tipoProdutos
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
        $tipoProduto = TipoProduto::find($id);
        if(is_null($tipoProduto)){
            return $this->sendError("Tipo Produto não encontrado");
        }
        return response()->json([
            "success" => true,
            "message" => "Tipo Produto recuperado com sucesso.",
            "data" => $tipoProduto
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\TipoProduto   $tipoProduto
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTipoProdutoRequest $request, TipoProduto $tipoProduto)
    {
        $inputs = $request->all();

        $tipoProduto->name = $inputs['name'];
        $tipoProduto->save();

        return response()->json([
            "success" => true,
            "message" => "Tipo Produto atualizado com sucesso.",
            "data" => $tipoProduto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\TipoProduto   $tipoProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoProduto $tipoProduto)
    {
        $tipoProduto->delete();
        return response()->json([
            "success" => true,
            "message" => "Tipo Produto deletado com sucesso.",
            "data" => $tipoProduto
        ]);
    }
}
