<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->increments('ID_Rec');
            $table->timestamps();
            $table->string('RecName',128);
            $table->string('RecTipo',32);
            $table->string('RecTipoOther',64);
            $table->string('RecSrc',255);
            $table->string('RecFormat',32);
            $table->unsignedInteger('FK_RecSol');
            $table->foreign('FK_RecSol')->references('ID_SolSer')->on('solicitud_servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotos');
    }
}
