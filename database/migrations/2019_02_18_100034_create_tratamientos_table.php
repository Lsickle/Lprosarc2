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
            $table->increments('ID_Trat');
            $table->timestamps();
            $table->string('TratName');
            $table->boolean('TratTipo');
            $table->unsignedInteger('FK_TratProv');
            $table->unsignedInteger('FK_TratRespel');

            $table->foreign('FK_TratProv')->references('ID_Cli')->on('Clientes');
            $table->foreign('FK_TratRespel')->references('ID_Respel')->on('Respels');
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
