<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RespelTarifa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respel_tarifa', function (Blueprint $table){
            $table->unsignedInteger('FK_Respel');
            $table->foreign('FK_Respel')->references('ID_Respel')->on('respels');
            $table->unsignedInteger('FK_Tarifa');
            $table->foreign('FK_Tarifa')->references('ID_Tarifa')->on('tarifas');
            $table->unsignedInteger('FK_Trat');
            $table->foreign('FK_Trat')->references('ID_Trat')->on('tratamientos');
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
        Schema::dropIfExists('respel_tarifa');
    }
}
