<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('ID_Horario');
            $table->date('HorarioFecha');
            $table->string('Horariotipo', 64);
            $table->string('HorariotipoOther');
            $table->boolean('HorarioFeriado');
            $table->dateTime('HorarioEntrada');
            $table->dateTime('HorarioSalida');
            $table->dateTime('HoraPermisoInicio');
            $table->dateTime('HoraPermisoFin');
            $table->unsignedInteger('FK_HoraPers');
            $table->foreign('FK_HoraPers')->references('ID_Pers')->on('personals');
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
        Schema::dropIfExists('horarios');
    }
}
