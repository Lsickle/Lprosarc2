<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respel extends Model
{
    protected $table='respels';

    protected $fillable=['RespelName', 'RespelDescrip', 'YRespelClasf4741',  'ARespelClasf4741', 'RespelIgrosidad', 'RespelEstado',' RespelHojaSeguridad', 'RespelTarj', 'RespelStatus','RespelDelete', 'RespelSlug', 'FK_RespelCoti'];

    protected $primaryKey = 'ID_Respel';

    public function getRouteKeyName()
	{
	    return 'RespelSlug';
    }
    
	public function Cotizacion()
	{
	 return $this->belongsTo('App\Cotizacion', 'FK_RespelCoti', 'ID_Coti');
	}

    public function Requerimiento(){
    	return $this->hasMany('App\Requerimiento','ID_Req', 'id');//como residuos tiene muchos requerimientos
    }

    // public function Tratamiento(){
    // 	return $this->hasMany('App\Tratamiento','ID_Trat','id');//como residuos tiene muchos tratamientos
    // }

    // public function SolicitudResiduo(){
    //     return $this->hasMany('App\SolicitudResiduo', 'ID_SolRes', 'id');//como solicitud de servicio tiene muchas solicitud de residuos
    // }
    
    public function ResiduosGener(){
		return $this->hasMany('App\ResiduosGener', 'ID_SGenerRes', 'id');
	}
}
