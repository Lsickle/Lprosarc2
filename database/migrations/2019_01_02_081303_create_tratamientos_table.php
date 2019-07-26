<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->increments('ID_Trat')->unique();
            $table->string('TratName');
            $table->boolean('TratTipo'); // 0=interno 1=externo
            $table->boolean('TratOfertado')->default(0);// 0=No Ofertado 1=Ofertado
            $table->timestamps();
            $table->unsignedInteger('FK_TratProv')->nullable();
            $table->foreign('FK_TratProv')->references('ID_Sede')->on('sedes')->onDelete('set null');
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
        Schema::dropIfExists('tratamientos');
    }
}
