<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMantenimitoVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MantenVehics', function (Blueprint $table) {
            $table->increments('ID_Mv');
            $table->integer('MvKm');
            $table->boolean('MvStatus');
            $table->string('MvType');
            $table->dateTime('HoraMavInicio');
            $table->dateTime('HoraMavFin');
            $table->timestamps();
            $table->unsignedInteger('FK_VehMan')->nullable();
            $table->foreign('FK_VehMan')->references('ID_Vehic')->on('vehiculos')->onDelete('cascade');
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
        Schema::dropIfExists('MantenVehics');
    }
}
