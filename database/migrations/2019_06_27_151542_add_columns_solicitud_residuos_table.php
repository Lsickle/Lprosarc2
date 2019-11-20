<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSolicitudResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->decimal('SolResCantiUnidadRecibida', 8, 1)->nullable();
            $table->decimal('SolResCantiUnidadConciliada', 8, 1)->nullable();
            $table->decimal('SolResCantiUnidadTratada', 8, 1)->nullable();
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
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->dropColumn('SolResCantiUnidadConciliada');
            $table->dropColumn('SolResCantiUnidadRecibida');
            $table->dropColumn('SolResCantiUnidadTratada');
        });
    }
}
