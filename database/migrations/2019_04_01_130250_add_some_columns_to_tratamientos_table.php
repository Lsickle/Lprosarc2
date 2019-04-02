<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnsToTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->string('TratPretratamiento')->nullable();
            $table->boolean('TratDelete');
            $table->unsignedInteger('FK_TratRespel')->nullable();
            $table->foreign('FK_TratRespel')->references('ID_Respel')->on('respels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->dropForeign('tratamientos_FK_TratRespel_foreign');
            $table->dropColumn('FK_TratRespel');
            $table->dropColumn('TratPretratamiento');
            $table->dropColumn('TratDelete');
        });
    }
}
