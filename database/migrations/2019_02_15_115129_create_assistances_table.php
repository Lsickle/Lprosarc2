<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistances', function (Blueprint $table) {
            $table->increments('ID_Asis');
            $table->date('AsisFecha');
            $table->dateTime('AsisLlegada');
            $table->dateTime('AsisSalida')->nullable();
            $table->integer('AsisNocturnas')->nullable();
            $table->boolean('AsisStatus');
            $table->timestamps();
            $table->unsignedInteger('FK_AsisPers')->nullable();
            $table->foreign('FK_AsisPers')->references('ID_Pers')->on('personals')->onDelete('cascade');
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
        Schema::dropIfExists('assistances');
    }
}
