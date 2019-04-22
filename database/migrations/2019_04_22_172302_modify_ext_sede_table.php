<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyExtSedeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sedes', function(Blueprint $table){
            $table->dropColumn('SedeExt1')->nullable()->change();
            $table->dropColumn('SedeExt2')->nullable()->change();
            $table->unsignedMediumInteger('SedeExt1')->nullable();
            $table->unsignedMediumInteger('SedeExt2')->nullable();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sedes', function(Blueprint $table){
            $table->unsignedSmallInteger('SedeExt1')->nullable();
            $table->unsignedSmallInteger('SedeExt2')->nullable();
        });
    }
}
