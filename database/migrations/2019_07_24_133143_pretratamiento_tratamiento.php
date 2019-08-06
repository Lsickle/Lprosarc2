<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PretratamientoTratamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pretratamiento_tratamiento', function (Blueprint $table){

            $table->unsignedInteger('FK_PreTrat');
            $table->foreign('FK_PreTrat')->references('ID_PreTrat')->on('pretratamientos')->onDelete('cascade');
            $table->unsignedInteger('FK_Trat');
            $table->foreign('FK_Trat')->references('ID_Trat')->on('tratamientos')->onDelete('cascade');
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
        Schema::dropIfExists('pretratamiento_tratamiento');
    }
}
