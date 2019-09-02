<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rangos', function (Blueprint $table) {
            $table->bigIncrements('ID_Rango');
            $table->string('TarifaPrecio');
            $table->string('TarifaDesde');
            $table->unsignedInteger('FK_RangoTarifa')->nullable();
            $table->foreign('FK_RangoTarifa')->references('ID_Tarifa')->on('tarifas')->onDelete('cascade');
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
        Schema::dropIfExists('rangos');
    }
}
