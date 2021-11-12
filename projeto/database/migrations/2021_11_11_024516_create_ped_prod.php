<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedProd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ped_prod', function (Blueprint $table) {
            $table->unsignedBigInteger('cod_ped');
            $table->unsignedBigInteger('cod_prod');
            $table->index(['cod_ped','cod_prod']);
            $table->foreign('cod_ped')->references('id')->on('pedido');
            $table->foreign('cod_prod')->references('id')->on('produto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ped_prod');
    }
}
