<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsToTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarifas', function (Blueprint $table) {
            $table->dropColumn('TarifaTipounidad2');
            $table->dropColumn('TarifaPesoinicial2');
            $table->dropColumn('TarifaPesofinal2');
            $table->dropColumn('TarifaPrecio2');
            $table->dropColumn('TarifaTipounidad3');
            $table->dropColumn('TarifaPesoinicial3');
            $table->dropColumn('TarifaPesofinal3');
            $table->dropColumn('TarifaPrecio3');
            $table->dropColumn('TarifaTipounidad1');
            $table->dropColumn('TarifaPesofinal1');
            $table->dropColumn('TarifaPesoinicial1');
            $table->dropColumn('TarifaPrecio1');
            $table->date('TarifaVencimiento')->nullable();
            $table->string('TarifaFrecuencia')->nullable();
            $table->string('Tarifatipo')->nullable();
            $table->unsignedInteger('FK_TarifaReq')->nullable();
            $table->foreign('FK_TarifaReq')->references('ID_Req')->on('requerimientos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarifas', function (Blueprint $table) {
            $table->string('TarifaTipounidad1');
            $table->integer('TarifaPesoinicial1');
            $table->integer('TarifaPesofinal1');
            $table->integer('TarifaPrecio1');
            $table->string('TarifaTipounidad2')->nullable();
            $table->integer('TarifaPesoinicial2')->nullable();
            $table->integer('TarifaPesofinal2')->nullable();
            $table->integer('TarifaPrecio2')->nullable();
            $table->string('TarifaTipounidad3')->nullable();
            $table->integer('TarifaPesoinicial3')->nullable();
            $table->integer('TarifaPesofinal3')->nullable();
            $table->integer('TarifaPrecio3')->nullable();
            $table->dropColumn('TarifaVencimiento');
            $table->dropColumn('TarifaFrecuencia');
            $table->dropColumn('Tarifatipo');
            $table->dropForeign('tarifas_fk_tarifareq_foreign');
            $table->dropColumn('FK_TarifaReq');
        });
    }
}
