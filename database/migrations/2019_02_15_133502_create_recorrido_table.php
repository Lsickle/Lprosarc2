<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecorridoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorridos', function (Blueprint $table) {
            $table->increments('ID_Recor');
            $table->timestamps();
            $table->unsignedInteger('FK_RecorSolSer');
            $table->unsignedInteger('FK_RecorProgveh');
            
            $table->foreign('FK_RecorSolSer')->references('ID_SolSer')->on('solicitud_servicios'); 
            $table->foreign('FK_RecorProgveh')->references('ID_ProgVeh')->on('ProgVehiculos'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recorrido');
    }
}
