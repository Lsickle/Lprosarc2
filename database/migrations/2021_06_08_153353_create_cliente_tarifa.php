<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientetarifa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientetarifa', function (Blueprint $table) {
            $table->bigIncrements('ID_CTarifa');
            $table->boolean('TarifaDelete');
            $table->date('TarifaVencimiento')->nullable();
            $table->string('TarifaFrecuencia')->nullable();
            $table->string('Tarifatipo')->nullable();
            $table->unsignedInteger('FK_Cliente')->nullable();
            $table->unsignedInteger('FK_Tratamiento')->nullable();
            $table->foreign('FK_Cliente')->references('ID_Cli')->on('clientes');
            $table->foreign('FK_Tratamiento')->references('ID_Trat')->on('tratamientos');
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
        Schema::dropIfExists('clientetarifa');
    }
}
