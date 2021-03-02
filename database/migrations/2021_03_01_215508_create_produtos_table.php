<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity')->nullable();
            $table->foreignId('tipo_produto_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('produtos', function(Blueprint $table){
            $table->foreign('tipo_produto_id')->references('id')->on('tipo_produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['tipo_produto_id']);
        });

        Schema::dropIfExists('produtos');
    }
}
