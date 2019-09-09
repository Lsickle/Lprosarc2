<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequerimientopublicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimientopublic', function (Blueprint $table) {
            $table->increments('ID_PReq');
            $table->boolean('PReqFotoCargue')->nullable();
            $table->boolean('PReqFotoDescargue')->nullable();
            $table->boolean('PReqFotoPesaje')->nullable();
            $table->boolean('PReqFotoDestruccion')->nullable();
            $table->boolean('PReqVideoCargue')->nullable();
            $table->boolean('PReqVideoDescargue')->nullable();
            $table->boolean('PReqVideoPesaje')->nullable();
            $table->boolean('PReqVideoReempacado')->nullable();
            $table->boolean('PReqVideoMezclado')->nullable();
            $table->boolean('PReqVideoDestruccion')->nullable();
            $table->boolean('PReqAuditoria')->nullable();
            $table->string('PReqAuditoriaTipo', 16)->nullable();
            $table->boolean('PReqDevolucion')->nullable();
            $table->string('PReqDevolucionTipo', 128)->nullable();
            $table->boolean('PReqDatosPersonal')->nullable();
            $table->boolean('PReqPlanillas')->nullable();
            $table->boolean('PReqAlistamiento')->nullable();
            $table->boolean('PReqCapacitacion')->nullable();
            $table->boolean('PReqCertiEspecial')->nullable();
            $table->string('PReqSlug')->unique()->nullable();
            $table->boolean('Pofertado')->nullable();
            $table->unsignedInteger('FK_PReqTrata')->nullable();
            $table->foreign('FK_PReqTrata')->references('ID_Trat')->on('tratamientos');
            $table->unsignedInteger('FK_PRespel')->nullable();
            $table->foreign('FK_PRespel')->references('ID_PRespel')->on('respelpublic');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requerimientopublic');
    }
}
