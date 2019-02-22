<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespelEnvio extends Model{
    protected $table='res_envios';
    protected $fillable = ['RespelKgEnviado','RespelKgRecibido','RespelKgConciliado','RespelKgTratado','FK_RespelEnvio'];
    protected $primaryKey = 'ID_ResEnv';

    public function ReciboMaterial(){
    	return $this->belogsTo('App\ReciboMaterial','ID_Rm');
    }
    public function Manifiesto(){
    	return $this>hasMany('App\Manifiesto','ID_ID_Manif','id');//como recibo de envio tiene muchos manifiestos
    }
}
