<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('ID_Cli')->unique();
            $table->string('CliNit', 20);
            $table->string('CliName');
            $table->string('CliShortname');
            $table->string('CliCode', 32)->nullable();
            $table->string('CliType', 32)->nullable();
            $table->string('CliCategoria',32);
            $table->boolean('CliAuditable');
            $table->timestamps();
            $table->string('CliSlug')->unique();
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
        Schema::dropIfExists('clientes');
    }
}
