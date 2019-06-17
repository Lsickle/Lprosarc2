<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('solicitud_residuos', function (Blueprint $table) {
            $table->increments('ID_SolRes');
            $table->Integer('SolResKgEnviado');
            $table->Integer('SolResKgRecibido')->nullable();
            $table->Integer('SolResKgConciliado')->nullable();
            $table->Integer('SolResKgTratado')->nullable();
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
        Schema::dropIfExists('solicitud_residuos');
    }
}
