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
            $table->string('GSedePhone1', 32)->nullable()->change();
            $table->unsignedSmallInteger('GSedeExt1')->nullable()->change();
            $table->string('GSedePhone2', 32)->nullable()->change();
            $table->unsignedSmallInteger('GSedeExt2')->nullable()->change();
            $table->string('GSedeEmail', 128);
            $table->string('GSedeCelular', 32)->nullable()->change();
            $table->unsignedInteger('FK_GSede');
            $table->unsignedInteger('FK_GSedeMun');
            $table->string('GSedeSlug')->unique();

            $table->foreign('FK_GSede')->references('ID_Gener')->on('generadors');
            $table->foreign('FK_GSedeMun')->references('ID_Mun')->on('municipios');
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
