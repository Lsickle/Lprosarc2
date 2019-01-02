<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respels', function (Blueprint $table) {
            $table->increments('ID_Respel');
            $table->string('RespelName', 128)->nullable();
            $table->text('RespelDescrip')->nullable();
            $table->string('RespelClasf4741', 64)->nullable();
            $table->string('RespelIgrosidad', 128)->nullable();
            $table->string('RespelEstado', 32)->nullable();
            $table->string('RespelHojaSeguridad', 128)->nullable();
            $table->string('RespelTarj', 128)->nullable();
            $table->string('RespelSlug')->unique();
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
        Schema::dropIfExists('respels');
    }
}
