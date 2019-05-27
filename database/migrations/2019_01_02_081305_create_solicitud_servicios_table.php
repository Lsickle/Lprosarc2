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
            $table->string('SolSerStatus', 16);
            $table->string('SolSerTipo', 32);
            $table->boolean('SolSerAuditable')->nullable();
            $table->string('SolSerConductor')->nullable();
            $table->string('SolSerVehiculo',12)->nullable();
            $table->string('SolSerSlug')->unique();
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
        Schema::dropIfExists('solicitud_servicios');
    }
}
