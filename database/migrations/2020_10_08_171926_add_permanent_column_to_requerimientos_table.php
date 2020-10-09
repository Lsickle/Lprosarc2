<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermanentColumnToRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requerimientos', function (Blueprint $table) {
            $table->boolean('auto_ReqFotoDescargue')->default(0);
            $table->boolean('auto_ReqFotoDestruccion')->default(0);
            $table->boolean('auto_ReqVideoDescargue')->default(0);
            $table->boolean('auto_ReqVideoDestruccion')->default(0);
            $table->boolean('auto_ReqDevolucion')->default(0);
            $table->boolean('auto_ReqAuditoria')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requerimientos', function (Blueprint $table) {
            $table->dropColumn('auto_ReqFotoDescargue');
            $table->dropColumn('auto_ReqFotoDestruccion');
            $table->dropColumn('auto_ReqVideoDescargue');
            $table->dropColumn('auto_ReqVideoDestruccion');
            $table->dropColumn('auto_ReqDevolucion');
            $table->dropColumn('auto_ReqAuditoria');
        });
    }
}
