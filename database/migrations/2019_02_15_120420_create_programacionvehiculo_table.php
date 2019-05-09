<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramacionvehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progvehiculos', function (Blueprint $table) {
            $table->increments('ID_ProgVeh');
            $table->date('ProgVehFecha');
            $table->integer('progVehKm')->nullable();
            $table->boolean('ProgVehTurno');
            $table->boolean('ProgVehtipo');
            $table->dateTime('ProgVehEntrada')->nullable();
            $table->dateTime('ProgVehSalida');
            $table->string('ProgVehColor')->nullable();
            $table->timestamps();
            $table->unsignedInteger('FK_ProgVehiculo')->nullable();
            $table->unsignedInteger('FK_ProgMan')->nullable();
            $table->foreign('FK_ProgVehiculo')->references('ID_Vehic')->on('vehiculos')->onDelete('cascade');
            $table->foreign('FK_ProgMan')->references('ID_Mv')->on('mantenvehics')->onDelete('cascade');
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
        Schema::dropIfExists('ProgVehiculos');
    }
}
