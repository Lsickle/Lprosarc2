<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificados', function (Blueprint $table) {
            $table->Integer('CertNumero')->nullable()->change();
            $table->string('CertiEspName',64)->nullable()->change();
            $table->string('CertiEspValue',64)->nullable()->change();
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
            $table->Integer('CertNumero');
            $table->string('CertiEspName',64);
            $table->string('CertiEspValue',64);
        });
    }
}
