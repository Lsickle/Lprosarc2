<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacions', function (Blueprint $table) {
            $table->bigIncrements('ID_Obs'); /* id de la observacion */
            $table->string('ObsStatus', 64); /* Aprobado Notificaco Completado etc */
            $table->text('ObsMensaje', 8000)->nullable(); /* texto de la observación */
            $table->string('ObsTipo', 64)->default('prosarc'); /* prosarc / cliente */
            $table->unsignedTinyInteger('ObsRepeat'); /* numero de repetición de una misma observacion */
            $table->timestamp('ObsDate'); /* fecha de la observacion */
            $table->string('ObsUser', 128); /* correo del usuario */
            $table->string('ObsRol', 64); /* rol del usuario */
            $table->unsignedInteger('FK_ObsSolSer')->nullable();
            $table->foreign('FK_ObsSolSer')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observacions');
    }
}
