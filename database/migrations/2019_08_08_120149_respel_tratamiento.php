<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RespelTratamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respel_tratamiento', function (Blueprint $table){

            $table->unsignedInteger('FK_Respel');
            $table->foreign('FK_Respel')->references('ID_Respel')->on('respels');
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
        Schema::dropIfExists('respel_tratamiento');
    }
}
