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
            $table->string('GSedePhone1', 32)->nullable();
            $table->unsignedSmallInteger('GSedeExt1')->nullable();
            $table->string('GSedePhone2', 32)->nullable();
            $table->unsignedSmallInteger('GSedeExt2')->nullable();
            $table->string('GSedeEmail', 128);
            $table->string('GSedeCelular', 32)->nullable();
            $table->timestamps();
            $table->string('GSedeSlug')->unique();
            $table->unsignedInteger('FK_GSede')->nullable();
            $table->unsignedInteger('FK_GSedeMun')->nullable();
            $table->foreign('FK_GSede')->references('ID_Gener')->on('generadors')->onDelete('cascade');
            $table->foreign('FK_GSedeMun')->references('ID_Mun')->on('municipios');
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
