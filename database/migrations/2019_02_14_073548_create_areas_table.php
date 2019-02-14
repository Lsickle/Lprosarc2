<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('ID_Area')->unique();
            $table->string('AreaName');
            $table->unsignedInteger('AreaSede');
            $table->unsignedInteger('GenerSede');
            $table->foreign('AreaSede')->references('ID_Sede')->on('sedes');
            $table->foreign('GenerSede')->references('ID_GSede')->on('gener_sedes');
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
        Schema::dropIfExists('areas');
    }
}
