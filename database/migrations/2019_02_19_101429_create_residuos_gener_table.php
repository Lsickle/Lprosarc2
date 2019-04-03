<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResiduosGenerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residuos_geners', function (Blueprint $table) {
            $table->increments('ID_SGenerRes');
            $table->timestamps();
            $table->unsignedInteger('FK_SGener')->nullable();
            $table->unsignedInteger('FK_Respel')->nullable();
            $table->unsignedInteger('FK_SolSer')->nullable();
            $table->foreign('FK_SGener')->references('ID_GSede')->on('gener_sedes')->onDelete('cascade');
            $table->foreign('FK_Respel')->references('ID_Respel')->on('respels')->onDelete('cascade');
            $table->foreign('FK_SolSer')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('cascade');
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
        Schema::dropIfExists('residuos_geners');
    }
}
