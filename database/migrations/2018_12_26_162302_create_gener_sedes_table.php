<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenerSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gener_sedes', function (Blueprint $table) {
            $table->increments('ID_GSede')->unique();
            $table->string('GSedeName', 128);
            $table->string('GSedeAddress');
            $table->string('GSedePhone1', 32);
            $table->unsignedSmallInteger('GSedeExt1');
            $table->string('GSedePhone2', 32);
            $table->unsignedSmallInteger('GSedeExt2');
            $table->string('GSedeEmail', 128);
            $table->string('GSedeCelular', 32);
            $table->unsignedInteger('Generador');
            $table->string('GSedeSlug')->unique();
            $table->foreign('Generador')->references('ID_Gener')->on('generadors');
            $table->timestamps();
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
        Schema::dropIfExists('gener_sedes');
    }
}
