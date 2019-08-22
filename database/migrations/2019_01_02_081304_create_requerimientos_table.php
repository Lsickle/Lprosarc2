<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimientos', function (Blueprint $table) {
            $table->increments('ID_Req');
            $table->boolean('ReqFotoCargue')->nullable();
            $table->boolean('ReqFotoDescargue')->nullable();
            $table->boolean('ReqFotoPesaje')->nullable();
            $table->boolean('ReqFotoReempacado')->nullable();
            $table->boolean('ReqFotoMezclado')->nullable();
            $table->boolean('ReqFotoDestruccion')->nullable();
            $table->boolean('ReqVideoCargue')->nullable();
            $table->boolean('ReqVideoDescargue')->nullable();
            $table->boolean('ReqVideoPesaje')->nullable();
            $table->boolean('ReqVideoReempacado')->nullable();
            $table->boolean('ReqVideoMezclado')->nullable();
            $table->boolean('ReqVideoDestruccion')->nullable();
            $table->boolean('ReqAuditoria')->nullable();
            $table->string('ReqAuditoriaTipo', 16)->nullable();
            $table->boolean('ReqDevolucion')->nullable();
            $table->string('ReqDevolucionTipo', 128)->nullable();
            $table->boolean('ReqDatosPersonal')->nullable();
            $table->boolean('ReqPlanillas')->nullable();
            $table->boolean('ReqAlistamiento')->nullable();
            $table->boolean('ReqCapacitacion')->nullable();
            $table->boolean('ReqBascula')->nullable();
            $table->boolean('ReqMasPerson')->nullable();
            $table->boolean('ReqPlatform')->nullable();
            $table->boolean('ReqCertiEspecial')->nullable();
            $table->string('ReqSlug')->unique();
            $table->timestamps();
            $table->unsignedInteger('FK_ReqRespel')->nullable();
            $table->foreign('FK_ReqRespel')->references('ID_Respel')->on('respels')->onDelete('SET NULL');
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
        Schema::dropIfExists('requerimientos');
    }
}
