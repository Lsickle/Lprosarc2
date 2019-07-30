<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnClientesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clientes', function (Blueprint $table) {
			$table->unsignedInteger('CliComercial')->nullable();
			$table->foreign('CliComercial')->references('ID_Pers')->on('personals')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clientes', function (Blueprint $table) {
			$table->dropForeign(['CliComercial']);
			$table->dropColumn('CliComercial');
		});
	}
}
