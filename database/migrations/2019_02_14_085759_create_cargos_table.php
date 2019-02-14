<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->increments('ID_Carg')->unique();
            $table->string('CargName',128);
            $table->bigInteger('CargSalary');
            $table->string('CargGrade',128);
            $table->unsignedInteger('CargOfi');
            $table->foreign('CargOfi')->references('ID_Ofi')->on('oficces');
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
        Schema::dropIfExists('cargos');
    }
}
