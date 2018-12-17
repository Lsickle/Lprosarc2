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
            $table->char('CliNit', 20);
            $table->char('CliName');
            $table->char('CliShortname', 64);
            $table->char('CliCode', 32);
            $table->char('CliType', 32);
            $table->char('CliCategoria',32);
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
