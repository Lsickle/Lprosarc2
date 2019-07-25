<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('CliRut')->nullable();
            $table->string('CliCamaraComercio')->nullable();
            $table->string('CliRepresentanteLegal')->nullable();
            $table->string('CliCertificaionBancaria')->nullable();
            $table->string('CliCertificaionComercial')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('CliRut');
            $table->dropColumn('CliCamaraComercio');
            $table->dropColumn('CliRepresentanteLegal');
            $table->dropColumn('CliCertificaionBancaria');
            $table->dropColumn('CliCertificaionComercial');
        });
    }
}
