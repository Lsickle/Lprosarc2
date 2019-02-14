<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOficcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficces', function (Blueprint $table) {
            $table->increments('ID_Ofi')->unique();
            $table->string('OfiAddress');
            $table->unsignedTinyInteger('OfiModule')->nullable();
            $table->unsignedInteger('OfiArea');
            $table->foreign('OfiArea')->references('ID_Area')->on('areas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oficces');
    }
}
