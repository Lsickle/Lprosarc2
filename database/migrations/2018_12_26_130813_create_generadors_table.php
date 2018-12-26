<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generadors', function (Blueprint $table) {
            $table->increments('ID_Gener');
            $table->string('GenerNit', 20);
            $table->string('GenerName');
            $table->string('GenerShortname', 64);
            $table->string('GenerCode', 32)->nullable();
            $table->string('GenerType', 32)->nullable();
            $table->boolean('GenerAuditable');
            $table->unsignedInteger('GenerCli');
            $table->timestamps();
            $table->string('GenerSlug')->unique();
            $table->foreign('GenerCli')->references('ID_Sede')->on('sedes');
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
        Schema::dropIfExists('generadors');
    }
}
