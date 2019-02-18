<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboMaterial extends Model{
    protected $table='recibo_materials';
    protected $fillable = ['RmStatus','RmTipo','RmAuditable','RmSalida','RmLlegada','RmCobro','FK_RmTransportador','FK_RmContact','FK_RmDeclar','FK_RmConductor','FK_RmProgVeh'];
    protected $primaryKey = 'ID_Rm';

    public function declarations(){
    	return $this->belongsTo('FK_RmDeclar','ID_Declar');
    }
    public function clientes(){
    	return $this->belongsTo('FK_RmTransportador','ID_Cli');
    }
    public function personals(){
    	return $this->belongsTo('FK_RmContact','ID_Pers');
    }
    public function personals(){
    	return $this->belongsTo('FK_RmConductor','ID_Pers');
    }
    public function progvehiculos(){
    	return $this->belongsTo('FK_RmProgVeh','ID_ProgVeh');
    }
    public function ResEnvio(){
        return $this->hasMany('App\ResEnvio','Id_ResEnv','id')//como recibo material tiene muchos envios 
    }
}
