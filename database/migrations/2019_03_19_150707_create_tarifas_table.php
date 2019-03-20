<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas', function (Blueprint $table) {
            $table->increments('ID_Tarifa');
            $table->string('TarifaTipounidad1');
            $table->integer('TarifaPesoinicial1');
            $table->integer('TarifaPesofinal1');
            $table->integer('TarifaPrecio1');
            $table->string('TarifaTipounidad2')->nullable();
            $table->integer('TarifaPesoinicial2')->nullable();
            $table->integer('TarifaPesofinal2')->nullable();
            $table->integer('TarifaPrecio2')->nullable();
            $table->string('TarifaTipounidad3')->nullable();
            $table->integer('TarifaPesoinicial3')->nullable();
            $table->integer('TarifaPesofinal3')->nullable();
            $table->integer('TarifaPrecio3')->nullable();
            $table->boolean('TarifaCotiDelete');
            $table->unsignedInteger('FK_TarifaTrat')->nullable();
            $table->foreign('FK_TarifaTrat')->references('ID_Trat')->on('tratamientos');
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
        Schema::dropIfExists('tarifas');
    }
}
