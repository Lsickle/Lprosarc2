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
            $table->string('TecnSerial',64)->unique();
            $table->string('TecnOs',32);
            $table->Integer('TecnRam');
            $table->string('TecnScreen',32);
            $table->string('TecnAccessory1',64)->nullable();
            $table->string('TecnAccessory2',64)->nullable();
            $table->string('Tecnobserv')->nullable();
            $table->timestamps();
            $table->unsignedInteger('FK_TecnPerson')->nullable();
            $table->foreign('FK_TecnPerson')->references('Id_Pers')->on('personals')->onDelete('set null');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
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
