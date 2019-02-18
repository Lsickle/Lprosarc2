<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_definitions', function (Blueprint $table) {
            $table->increments('ID_Dato');
            $table->timestamps();
            $table->string('DatoName',32);/*nombre del campo en la base de datos*/
            $table->string('DatoDescrip',255); /*indica lo que representa en el sistema*/
            $table->string('DatoAlias',128); /*si tiene varios nombres en diferentes areas*/
            $table->string('DatoTipo',32); /*tipo de dato ejem:varchar, si/no(boolean), int(numero entero),
         ect...*/
            $table->integer('DatoLongi'); /*tamaño del campo en numero de caracteres*/
            $table->string('DatoEstructura',64);/*indica a que proceso o tabla pertenece el dato*/
            $table->string('DatoRelacion',32);/*indica el tipo de relacion sobre otros datos, segun se lista a continuacion
        Relación secuencial: define los componentes que siempre se incluyen en una estructura de datos.
        Relación de selección: (uno u otro), define las alternativas para datos o estructuras de datos incluidos en una estructura de datos.
        Relación de iteración: (repetitiva), define la repetición de un componente.
        Relación opcional: los datos pueden o no estar incluidos, o sea, una o ninguna iteración*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_definitions');
    }
}
