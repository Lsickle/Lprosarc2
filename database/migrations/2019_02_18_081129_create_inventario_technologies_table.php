<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarioTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario_technologies', function (Blueprint $table) {
            $table->increments('ID_Tecn');
            $table->string('TecnBrand',64);
            $table->string('TecnModel',64);
            $table->string('TecnSerial',64);
            $table->string('TecnNumber',32);
            $table->string('TecnOs',32);
            $table->Integer('TecnRam');
            $table->string('TecnScreen',32);
            $table->string('TecnAccessory1',64);
            $table->string('TecnAccessory2',64);
            $table->string('Tecnobserv');
            $table->unsignedInteger('FK_TecnPerson');
            $table->foreign('FK_TecnPerson')->references('Id_Pers')->on('personals');
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
        Schema::dropIfExists('inventario_technologies');
    }
}
