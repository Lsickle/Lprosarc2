<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifiestoCargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifiestos_carga', function (Blueprint $table) {
            $table->bigIncrements('ID_ManiCarg');
            $table->unsignedInteger('FK_ManiCargSolSer')->nullable();
            $table->foreign('FK_ManiCargSolSer')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('cascade');
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
        Schema::dropIfExists('manifiestos_carga');
    }
}
