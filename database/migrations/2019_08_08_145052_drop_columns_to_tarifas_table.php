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
            $table->dropColumn('TarifaPesofinal1');
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
            $table->string('TarifaTipounidad2')->nullable();
            $table->integer('TarifaPesoinicial2')->nullable();
            $table->integer('TarifaPesofinal2')->nullable();
            $table->integer('TarifaPrecio2')->nullable();
            $table->string('TarifaTipounidad3')->nullable();
            $table->integer('TarifaPesoinicial3')->nullable();
            $table->integer('TarifaPesofinal3')->nullable();
            $table->integer('TarifaPrecio3')->nullable();
            $table->integer('TarifaPesofinal1');
        });
    }
}
