<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespelEnviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('respel_envios', function (Blueprint $table) {
            $table->increments('ID_ResEnv');
            $table->string('RespelEstado', 32)->nullable();
            $table->Integer('RespelKgEnviado');
            $table->Integer('RespelKgRecibido');
            $table->Integer('RespelKgConciliado');
            $table->Integer('RespelKgTratado');
            $table->unsignedInteger('RespelDeclar');
            $table->unsignedInteger('RespelReq');
            $table->unsignedInteger('RespelGenerSede');
            $table->foreign('RespelDeclar')->references('ID_Declar')->on('declarations');
            $table->foreign('RespelReq')->references('ID_Req')->on('requerimientos');
            $table->foreign('RespelGenerSede')->references('ID_GSede')->on('gener_sedes');
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
