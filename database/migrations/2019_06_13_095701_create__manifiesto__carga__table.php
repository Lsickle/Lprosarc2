<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifiestoCargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifiestos_carga', function (Blueprint $table) {
            $table->bigIncrements('ID_ManiCarg');
            $table->unsignedInteger('FK_ManiCargProgVeh')->nullable();
            $table->foreign('FK_ManiCargProgVeh')->references('ID_ProgVeh')->on('progvehiculos')->onDelete('cascade');
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
        Schema::dropIfExists('manifiestos_carga');
    }
}
