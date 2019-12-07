<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecolectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recolect', function (Blueprint $table) {
            $table->increments('ID_Colect');
            $table->unsignedInteger('FK_ColectSgen')->nullable();
            $table->unsignedInteger('FK_ColectProg')->nullable();
            $table->foreign('FK_ColectSgen')->references('ID_GSede')->on('gener_sedes');
            $table->foreign('FK_ColectProg')->references('ID_ProgVeh')->on('progvehiculos');
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
        Schema::dropIfExists('recolect');
    }
}
