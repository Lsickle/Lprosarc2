<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResEnvio extends Model{
    protected $table='res_evios';
    protected $fillable = ['RespelKgEnviado','RespelKgRecibido','RespelKgConciliado','RespelKgTratado','FK_RespelEnvio'];
    protected $primaryKey = 'ID_ResEnv';

    public function ReciboMaterial(){
    	return $this->belogsTo('FK_RespelEnvio','Id_Rm');
    }
}
