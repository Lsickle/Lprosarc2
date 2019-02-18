<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReciboMaterial extends Model{
    protected $table='recibo_materials';
    protected $fillable = ['RmStatus','RmTipo','RmAuditable','RmSalida','RmLlegada','RmCobro','FK_RmTransportador','FK_RmContact','FK_RmDeclar','FK_RmConductor','FK_RmProgVeh'];
    protected $primaryKey = 'ID_Rm';

    public function declarations(){
    	return $this->belongsTo('App\Declaration','ID_Declar');
    }
    public function clientes(){
    	return $this->belongsTo('App\Cliente','ID_Cli');
    }
    public function personals(){
    	return $this->belongsTo('App\Personal','ID_Pers');
    }
    public function personals(){
    	return $this->belongsTo('App\Personal','ID_Pers');
    }
    public function progvehiculos(){
    	return $this->belongsTo('App\ProgramacionVehiculo','ID_ProgVeh');
    }
    public function ResEnvio(){
        return $this->hasMany('App\ResEnvio','Id_ResEnv','id')//como recibo material tiene muchos envios 
    }
    public function Manifiesto(){
        return $this>hasMany('App\Manifiesto','ID_ID_Manif','id');//como recibo material tiene muchos manifiestos
    }
}
