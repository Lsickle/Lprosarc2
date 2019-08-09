<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PretratamientoRespel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pretratamiento_respel', function (Blueprint $table){

            $table->unsignedInteger('FK_Respel');
            $table->foreign('FK_Respel')->references('ID_Respel')->on('respels');
            $table->unsignedInteger('FK_PreTrat');
            $table->foreign('FK_PreTrat')->references('ID_PreTrat')->on('pretratamientos');
            $table->unsignedInteger('FK_Trat');
            $table->foreign('FK_Trat')->references('ID_Trat')->on('tratamientos');
            $table->boolean('Ofertado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pretratamiento_respel');
    }
}
