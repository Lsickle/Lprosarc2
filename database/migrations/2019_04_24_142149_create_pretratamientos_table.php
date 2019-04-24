<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePretratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pretratamientos', function (Blueprint $table) {
            $table->increments('ID_PreTrat');
            $table->string('PreTratName');
            $table->boolean('PreTratDelete');
            $table->unsignedInteger('FK_Pre_Trat');
            $table->foreign('FK_Pre_Trat')->references('ID_Trat')->on('tratamientos');
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
        Schema::dropIfExists('pretratamientos');
    }
}
