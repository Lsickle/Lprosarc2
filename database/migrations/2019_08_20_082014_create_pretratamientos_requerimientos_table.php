<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePretratamientosRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pretratamientos_requerimientos', function (Blueprint $table) {
            $table->bigIncrements('ID_RequeCli');
            $table->unsignedInteger('FK_Req');
            $table->foreign('FK_Req')->references('ID_Req')->on('requerimientos');
            $table->unsignedInteger('FK_PreTrat');
            $table->foreign('FK_PreTrat')->references('ID_PreTrat')->on('pretratamientos');
            $table->boolean('selected');
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
        Schema::dropIfExists('pretratamientos_requerimientos');
    }
}
