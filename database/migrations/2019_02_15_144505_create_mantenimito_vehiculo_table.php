<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimitoVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MantenVehics', function (Blueprint $table) {
            $table->increments('ID_Mv');
            $table->timestamps();
            $table->date('MvTecnicoMecanica');
            $table->integer('MvKm');
            $table->date('MvAceite');
            $table->date('Mvtanqueo');
            $table->integer('MvtanqueoCant');
            $table->unsignedInteger('FK_MvProgram');
            
            $table->foreign('FK_MvProgram')->references('ID_ProgVeh')->on('ProgVehiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimito_vehiculo');
    }
}
