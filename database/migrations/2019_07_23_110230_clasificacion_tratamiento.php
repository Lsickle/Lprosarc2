<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClasificacionTratamiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasificacion_tratamiento', function (Blueprint $table){

            $table->unsignedInteger('FK_Clasf');
            $table->foreign('FK_Clasf')->references('ID_Clasf')->on('clasificacion')->onDelete('cascade');
            $table->unsignedInteger('FK_Trat');
            $table->foreign('FK_Trat')->references('ID_Trat')->on('tratamientos')->onDelete('cascade');
            $table->timestamps();
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
        Schema::dropIfExists('clasificacion_tratamiento');
    }
}
