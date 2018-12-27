<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToSomesColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gener_sedes', function (Blueprint $table) {
            $table->string('GSedePhone1', 32)->nullable()->change();
            $table->unsignedSmallInteger('GSedeExt1')->nullable()->change();
            $table->string('GSedePhone2', 32)->nullable()->change();
            $table->unsignedSmallInteger('GSedeExt2')->nullable()->change();
            $table->string('GSedeCelular', 32)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gener_sedes', function (Blueprint $table) {
            $table->string('GSedePhone1', 32)->change();
            $table->unsignedSmallInteger('GSedeExt1')->change();
            $table->string('GSedePhone2', 32)->change();
            $table->unsignedSmallInteger('GSedeExt2')->change();
            $table->string('GSedeCelular', 32)->change();
        });
    }
}
