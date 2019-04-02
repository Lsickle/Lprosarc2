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
            $table->string('SedeName', 128);
            $table->string('SedeAddress', 255);
            $table->string('SedePhone1', 32)->nullable();
            $table->unsignedSmallInteger('SedeExt1')->nullable();
            $table->string('SedePhone2', 32)->nullable();
            $table->unsignedSmallInteger('SedeExt2')->nullable();
            $table->string('SedeEmail', 128);
            $table->string('SedeCelular', 32)->nullable();
            $table->timestamps();  
            $table->string('SedeSlug')->unique();
            $table->unsignedInteger('FK_SedeCli')->nullable();
            $table->unsignedInteger('FK_SedeMun')->nullable();
            $table->foreign('FK_SedeCli')->references('ID_Cli')->on('clientes')->onDelete('cascade');
            $table->foreign('FK_SedeMun')->references('ID_Mun')->on('municipios');
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
        Schema::dropIfExists('sedes');
    }
}
