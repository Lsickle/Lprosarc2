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
            $table->date('CapaPersDate');
            $table->date('CapaPersExpire');
            $table->timestamps();
            $table->unsignedInteger('FK_Pers')->nullable();
            $table->unsignedInteger('FK_Sede')->nullable();
            $table->unsignedInteger('FK_Capa')->nullable();
            $table->foreign('FK_Sede')->references('ID_Sede')->on('sedes')->onDelete('cascade');
            $table->foreign('FK_Capa')->references('ID_Capa')->on('trainings')->onDelete('cascade');
            $table->foreign('FK_Pers')->references('ID_Pers')->on('personals')->onDelete('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
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
