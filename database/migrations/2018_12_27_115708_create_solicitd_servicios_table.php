<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_servicios', function (Blueprint $table) {
            $table->increments('ID_SolSer');
            $table->string('SolSerApply', 16)->nullable();
            $table->string('SolSerTipo', 32);
            $table->string('SolSerName');
            $table->string('SolSerStatus', 16);
            $table->unsignedTinyInteger('SolSerFrecuencia')->nullable();
            $table->boolean('SolSerAuditable');
            $table->unsignedInteger('SolSerSede');
            $table->unsignedInteger('SolSerGenerSede')->nullable();
            $table->unsignedInteger('SolSerUser');
            $table->timestamps();
            $table->string('SolSerSlug')->unique();
            $table->foreign('SolSerSede')->references('ID_Sede')->on('sedes');
            $table->foreign('SolSerGenerSede')->references('ID_GSede')->on('gener_sedes');
            $table->foreign('SolSerUser')->references('id')->on('users');
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
        Schema::dropIfExists('solicitud_servicios');
    }
}
