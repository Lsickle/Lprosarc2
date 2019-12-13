<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifdatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifdato', function (Blueprint $table) {
            $table->increments('ID_ManifDato');
            $table->unsignedInteger('FK_DatoManif')->nullable();
            $table->unsignedInteger('FK_DatoManifSolRes')->nullable();
            $table->foreign('FK_DatoManif')->references('ID_Manif')->on('manifiestos');
            $table->foreign('FK_DatoManifSolRes')->references('ID_SolRes')->on('solicitud_residuos');
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
        Schema::dropIfExists('manifdato');
    }
}
