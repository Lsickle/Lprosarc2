<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('res_envios', function (Blueprint $table) {
            $table->increments('ID_ResEnv');
            $table->Integer('RespelKgEnviado');
            $table->Integer('RespelKgRecibido');
            $table->Integer('RespelKgConciliado');
            $table->Integer('RespelKgTratado');
            $table->unsignedInteger('FK_RespelEnvio');
            $table->foreign('FK_RespelEnvio')->references('ID_Rm')->on('recibo_materials');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('res_envios');
    }
}
