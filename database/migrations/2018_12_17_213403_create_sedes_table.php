<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->increments('ID_Sede')->unique();
            $table->char('SedeName');
            $table->char('SedeAddress');
            $table->char('SedePhone1');
            $table->unsignedSmallInteger('SedeExt1');
            $table->char('SedePhone2');
            $table->unsignedSmallInteger('SedeExt2');
            $table->char('SedeEmail');
            $table->char('SedeCelular');
            $table->unsignedInteger('Cliente');
            $table->char('SedeSlug')->unique();
            $table->foreign('Cliente')->references('ID_Cli')->on('clientes');
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
        Schema::dropIfExists('sedes');
    }
}
