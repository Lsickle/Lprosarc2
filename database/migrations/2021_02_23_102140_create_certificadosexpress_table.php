<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificadosexpressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificadosexpress', function (Blueprint $table) {
            $table->increments('ID_Cert');
            $table->Integer('CertType'); /*tipo de certificado*/
            $table->string('CertNumero', 16); /*numero de certificado opcional*/
            $table->string('CertiEspName', 64);
            $table->string('CertiEspValue', 64);
            $table->string('CertObservacion');
            $table->string('CertSrc'); /*nombre del documento*/
            $table->string('CertSlug'); /*slug para la url del documento*/
            $table->string('CertNumRm'); /*numero de recibo de material alque corresponde*/
            $table->boolean('CertAuthHseq');
            $table->boolean('CertAuthJo');
            $table->boolean('CertAuthJl');
            $table->boolean('CertAuthDp');
            $table->string('CertAnexo');
            $table->unsignedInteger('CertManifNumero')->nullable(); //numero de manifiesto M-31542
            $table->string('CertNumeroExt', 24)->nullable();//numero de certificado otros gestores 899006
            $table->string('CertManifPrepend',8)->nullable(); //sufijo para numero de manifiesto
            $table->string('CertSrcManif')->default('CertificadoDefault.pdf'); //ubicacion de manifiesto
            $table->string('CertSrcExt')->default('CertificadoDefault.pdf'); //ubicacion de certificado externo
            $table->timestamps();
            $table->unsignedInteger('FK_CertSolser')->nullable();
            $table->foreign('FK_CertSolser')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('set null');
            $table->unsignedInteger('FK_CertCliente')->nullable();
            $table->foreign('FK_CertCliente')->references('ID_Cli')->on('clientes')->onDelete('set null');
            $table->unsignedInteger('FK_CertGenerSede')->nullable();
            $table->foreign('FK_CertGenerSede')->references('ID_GSede')->on('gener_sedes')->onDelete('set null');
            $table->unsignedInteger('FK_CertGestor')->nullable();
            $table->foreign('FK_CertGestor')->references('ID_Cli')->on('clientes')->onDelete('set null');
            $table->unsignedInteger('FK_CertTrat')->nullable();
            $table->foreign('FK_CertTrat')->references('ID_Trat')->on('tratamientos')->onDelete('set null');
            $table->unsignedInteger('FK_CertTransp')->nullable();
            $table->foreign('FK_CertTransp')->references('ID_Cli')->on('clientes')->onDelete('set null');
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
        Schema::dropIfExists('certificadosexpress');
    }
}
