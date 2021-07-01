<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefactura extends Model
{
    protected $table='prefacturas';
    protected $fillable = ['Costo_transporte', 'Subtotal_procesos', 'Total_prefactura', 'status_prefactura', 'orden_compra', 'Fecha_Servicio', 'FK_Comercial', 'FK_Cliente', 'FK_Servicio'];
    protected $primaryKey = 'ID_Prefactura';

    public function comercial(){
    	return $this->belongsTo('App\Personal','FK_Comercial','ID_Pers');
    }
    public function cliente(){
    	return $this->belongsTo('App\Cliente','FK_Cliente', 'ID_Cli');
    }
    public function servicio(){
    	return $this->belongsTo('App\SolicitudServicio','FK_Servicio','ID_SolSer');
    }


    public function prefacTratamiento(){
    	return $this->hasMany('App\PrefacturaTratamiento', 'FK_Prefactura', 'ID_Prefactura');//Como una area tiene muchos cargos
    }
}
