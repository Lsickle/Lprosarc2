<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertexpressdatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certexpressdato', function (Blueprint $table) {
            $table->increments('ID_CertDato');
            $table->unsignedInteger('FK_DatoCert')->nullable();
            $table->unsignedInteger('FK_DatoCertSolRes')->nullable();
            $table->foreign('FK_DatoCert')->references('ID_Cert')->on('certificadosexpress');
            $table->foreign('FK_DatoCertSolRes')->references('ID_SolRes')->on('solicitud_residuos');
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
        Schema::dropIfExists('certexpressdato');
    }
}
