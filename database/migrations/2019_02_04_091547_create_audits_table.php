<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('AuditTabla');
            $table->string('AuditRegistro');
            $table->string('AuditUser');
            $table->string('Auditlog'); /*coniene toda la informacion del request con el que solicita el update, si el request tiene archivos tambien viene el nombre del archivo nuevo*/



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audits');
    }
}
