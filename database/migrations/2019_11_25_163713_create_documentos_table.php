<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('ID_Doc');
            $table->tinyInteger('DocType');
            $table->Integer('DocNumero');
            $table->string('DocEspName',64);
            $table->string('DocEspValue',64);
            $table->string('DocObservacion');
            $table->string('DocSrc');
            $table->string('DocSlug');
            $table->string('DocNumRm'); /*numero de recibo de material*/
            $table->boolean('DocAuthHseq'); /*firma hseq*/
            $table->boolean('DocAuthJl'); /*firma jefe logistica*/
            $table->boolean('DocAuthDp'); /*firma director planta*/
            $table->string('DocAnexo'); /*nombre del documento anexo*/
            $table->timestamps();
            $table->unsignedInteger('FK_CertSolser')->nullable();
            $table->foreign('FK_CertSolser')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('set null');
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
        Schema::dropIfExists('documentos');
    }
}
