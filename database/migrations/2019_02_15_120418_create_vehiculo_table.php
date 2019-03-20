<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('ID_Vehic');
            $table->timestamps();
            $table->string('VehicPlaca',12)->unique();
            $table->string('VehicTipo',64);
            $table->string('VehicCapacidad',64);
            $table->integer('VehicKmActual');
            $table->boolean('VehicInternExtern');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
