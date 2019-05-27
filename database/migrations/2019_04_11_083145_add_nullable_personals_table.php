<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullablePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personals', function(Blueprint $table){
            $table->string('PersDocType',6)->nullable()->change();
            $table->string('PersDocNumber',25)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personals', function(Blueprint $table){
            $table->string('PersDocType',6);
            $table->string('PersDocNumber',25);
        });
    }
}
