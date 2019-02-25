<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudResiduo extends Model{
    protected $table='solicitud_residuos';
    protected $fillable = ['SolResKgEnviado','SolResKgRecibido','SolResKgConciliado','SolResKgTratado'];
    protected $primaryKey = 'ID_SolRes';

    public function SolicitudServicio(){
    	return $this->belogsTo('App\SolicitudServicio','ID_SolSer');
    }
    public function Repel(){
    	return $this->belogsTo('App\Repel', 'ID_Respel');
    }
}
