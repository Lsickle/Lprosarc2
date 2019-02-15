<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_personals', function (Blueprint $table) {
            $table->increments('ID_CapPers');
            $table->unsignedInteger('FK_Sede');
            $table->unsignedInteger('FK_Capa');
            $table->unsignedInteger('FK_Pers');
            $table->foreign('FK_Sede')->references('ID_Sede')->on('sedes');
            $table->foreign('FK_Capa')->references('ID_Capa')->on('trainings');
            $table->foreign('FK_Pers')->references('ID_Pers')->on('personals');
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
        Schema::dropIfExists('training_personals');
    }
}
