<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respel extends Model
{
    protected $table='respels';

    protected $fillable=['RespelName', 'RespelDescrip', 'YRespelClasf4741', 'ARespelClasf4741', 'RespelIgrosidad', 'RespelEstado',' RespelHojaSeguridad', 'RespelTarj', 'RespelStatus','RespelDelete', 'RespelSlug', 'FK_RespelCoti', 'RespelStatusDescription'];

    protected $primaryKey = 'ID_Respel';

    public function getRouteKeyName()
	{
	    return 'RespelSlug';
    }
    
	public function Cotizacion()
	{
	    return $this->belongsTo('App\Cotizacion', 'FK_RespelCoti', 'ID_Coti');
	}

    // public function SolicitudResiduo(){
    //     return $this->hasMany('App\SolicitudResiduo', 'ID_SolRes', 'id');//como solicitud de servicio tiene muchas solicitud de residuos
    // }
    
    public function ResiduosGener(){
		return $this->hasMany('App\ResiduosGener', 'ID_SGenerRes', 'id');
	}

    // lista los requerimientos de un residuo 1 a muchos
    public function requerimientos(){
        return $this->hasMany('App\Requerimiento', 'FK_ReqRespel', 'ID_Respel');
        //como residuos tiene muchos requerimientos
    }
}
