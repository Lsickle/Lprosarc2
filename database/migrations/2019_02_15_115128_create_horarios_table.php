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
            $table->timestamps();
            $table->unsignedInteger('FK_HoraPers')->nullable();
            $table->foreign('FK_HoraPers')->references('ID_Pers')->on('personals')->onDelete('cascade');
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
        Schema::dropIfExists('horarios');
    }
}
