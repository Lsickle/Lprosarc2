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
            $table->string('CertTipo',64);
            $table->Integer('CertNumero');
            $table->Integer('CertKg');
            $table->string('CertiEspName',64);
            $table->string('CertiEspValue',64);
            $table->string('CertObservacion');
            $table->string('CertSrc');
            $table->string('CertAnexo');
            $table->unsignedInteger('FK_CertRm');
            $table->unsignedInteger('FK_CertGener');
            $table->unsignedInteger('FK_CertRespel');
            $table->foreign('FK_CertRm')->references('ID_Rm')->on('recibo_materials');
            $table->foreign('FK_CertGener')->references('ID_GSede')->on('gener_sedes');
            $table->foreign('FK_CertRespel')->references('ID_ResEnv')->on('respel_envios');
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
        Schema::dropIfExists('certificados');
    }
}
