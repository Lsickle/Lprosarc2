<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificados', function (Blueprint $table) {
            $table->increments('ID_Cert');
            $table->Integer('CertNumero');
            $table->string('CertiEspName',64);
            $table->string('CertiEspValue',64);
            $table->string('CertObservacion');
            $table->string('CertSrc');
            $table->boolean('CertAuthJo');
            $table->boolean('CertAuthJl');
            $table->boolean('CertAuthDp');
            $table->string('CertAnexo');
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
        Schema::dropIfExists('certificados');
    }
}
