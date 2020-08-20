<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManifColumnsToCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificados', function (Blueprint $table) {
            $table->unsignedInteger('CertManifNumero')->nullable(); //numero de manifiesto M-31542
            $table->string('CertNumeroExt', 24)->nullable();//numero de certificado otros gestores 899006
            $table->string('CertManifPrepend',8)->nullable(); //sufijo para numero de manifiesto
            $table->string('CertSrcManif')->default('CertificadoDefault.pdf'); //ubicacion de manifiesto
            $table->string('CertSrcExt')->default('CertificadoDefault.pdf'); //ubicacion de certificado externo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificados', function (Blueprint $table) {
            $table->dropColumn('CertManifNumero');
            $table->dropColumn('CertNumeroExt');
            $table->dropColumn('CertManifPrepend');
            $table->dropColumn('CertSrcManif');
            $table->dropColumn('CertSrcExt');
        });
    }
}
