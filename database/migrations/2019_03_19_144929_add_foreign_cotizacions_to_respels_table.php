<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignCotizacionsToRespelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('respels', function (Blueprint $table) {
            $table->unsignedInteger('FK_RespelCoti')->nullable();
            $table->foreign('FK_RespelCoti')->references('ID_Coti')->on('cotizacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respels', function (Blueprint $table) {
            $table->dropColumn('FK_RespelCoti');
        });
    }
}
