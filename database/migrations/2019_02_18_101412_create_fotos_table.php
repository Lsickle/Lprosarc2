<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos', function (Blueprint $table) {
            $table->increments('ID_Foto');
            $table->timestamps();
            $table->string('FotoName',128);
            $table->string('FotoTipo',32);
            $table->string('FotoTipoOther',64);
            $table->string('FotoSrc',255);
            $table->string('FotoFormat',32);
            $table->unsignedInteger('FK_FotoRespel');
            $table->foreign('FK_FotoRespel')->references('ID_ResEnv')->on('res_envios');
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
