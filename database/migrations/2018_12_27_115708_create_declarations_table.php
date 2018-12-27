<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeclarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declarations', function (Blueprint $table) {
            $table->increments('ID_Declar');
            $table->string('DeclarApply', 16)->nullable();
            $table->string('DeclarTipo', 32);
            $table->string('DeclarName');
            $table->string('DeclarStatus', 16);
            $table->unsignedTinyInteger('DeclarFrecuencia')->nullable();
            $table->boolean('DeclarAuditable');
            $table->unsignedInteger('DeclarSede');
            $table->unsignedInteger('DeclarGenerSede')->nullable();
            $table->unsignedInteger('DeclarUser');
            $table->timestamps();
            $table->string('DeclarSlug')->unique();
            $table->foreign('DeclarSede')->references('ID_Sede')->on('sedes');
            $table->foreign('DeclarGenerSede')->references('ID_GSede')->on('gener_sedes');
            $table->foreign('DeclarUser')->references('id')->on('users');
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
        Schema::dropIfExists('declarations');
    }
}
