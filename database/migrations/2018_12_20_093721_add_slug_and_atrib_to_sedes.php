<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugAndAtribToSedes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sedes', function (Blueprint $table) {
            $table->unsignedSmallInteger('SedeExt1')->nullable()->change();
            $table->string('SedePhone2')->nullable()->change();
            $table->unsignedSmallInteger('SedeExt2')->nullable()->change();
            $table->string('SedeEmail')->nullable()->change();
            $table->string('SedeCelular')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sedes', function (Blueprint $table) {
            $table->unsignedSmallInteger('SedeExt1')->change();
            $table->string('SedePhone2')->change();
            $table->unsignedSmallInteger('SedeExt2')->change();
            $table->string('SedeEmail')->change();
            $table->string('SedeCelular')->change();
        });
    }
}
