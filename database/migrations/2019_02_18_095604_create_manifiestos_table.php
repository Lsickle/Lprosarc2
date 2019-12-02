<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifiestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifiestos', function (Blueprint $table) {
            $table->increments('ID_Manif');
            $table->Integer('ManifType'); /*tipo de manifiestos*/
            $table->string('ManifNumero', 16); /*numero de manifiestos opcional*/
            $table->string('ManifiEspName',64);
            $table->string('ManifiEspValue',64);
            $table->string('ManifObservacion');
            $table->string('ManifSrc'); /*nombre del documento*/
            $table->string('ManifSlug'); /*slug para la url del documento*/
            $table->string('ManifNumRm'); /*numero de recibo de material alque corresponde*/
            $table->boolean('ManifAuthHseq');
            $table->boolean('ManifAuthJo');
            $table->boolean('ManifAuthJl');
            $table->boolean('ManifAuthDp');
            $table->string('ManifAnexo');
            $table->timestamps();
            $table->unsignedInteger('FK_ManifSolser')->nullable();
            $table->foreign('FK_ManifSolser')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('set null');
            $table->unsignedInteger('FK_ManifCliente')->nullable();
            $table->foreign('FK_ManifCliente')->references('ID_Cli')->on('clientes')->onDelete('set null');
            $table->unsignedInteger('FK_ManifGenerSede')->nullable();
            $table->foreign('FK_ManifGenerSede')->references('ID_GSede')->on('gener_sedes')->onDelete('set null');
            $table->unsignedInteger('FK_ManifGestor')->nullable();
            $table->foreign('FK_ManifGestor')->references('ID_Cli')->on('clientes')->onDelete('set null');
            $table->unsignedInteger('FK_ManifTrat')->nullable();
            $table->foreign('FK_ManifTrat')->references('ID_Trat')->on('tratamientos')->onDelete('set null');
            $table->unsignedInteger('FK_ManifTransp')->nullable();
            $table->foreign('FK_ManifTransp')->references('ID_Cli')->on('clientes')->onDelete('set null');
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
        Schema::dropIfExists('manifiestos');
    }
}
