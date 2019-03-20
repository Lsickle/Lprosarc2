<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResiduosGenerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residuos_geners', function (Blueprint $table) {
            $table->increments('ID_SGenerRes');
            $table->unsignedInteger('FK_SGener');
            $table->unsignedInteger('FK_Respel');
            $table->unsignedInteger('FK_SolSer');
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
        Schema::dropIfExists('residuos_geners');
    }
}
