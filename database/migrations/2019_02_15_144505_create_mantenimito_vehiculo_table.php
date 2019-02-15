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
            $table->unsignedInteger('FK_ManVehiculo');
            
            
            $table->foreign('FK_MvProgram')->references('ID_ProgVeh')->on('ProgVehiculos');
            $table->foreign('FK_ManVehiculo')->references('ID_Vehic')->on('Vehiculos');
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
