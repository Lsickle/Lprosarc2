<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respel extends Model
{
    protected $table='respels';

    protected $fillable=['RespelName', 'RespelDescrip', 'YRespelClasf4741',  'ARespelClasf4741', 'RespelIgrosidad', 'RespelEstado',' RespelHojaSeguridad', 'RespelTarj', 'RespelStatus', 'RespelSlug'];

    protected $primaryKey = 'ID_Respel';

    public function getRouteKeyName()
	{
	    return 'RespelSlug';
    }
    
	public function requerimientos()
	{
	 return $this->belongsTo('App\Requerimiento', 'ID_Req');
	}

    public function Tratamiento(){
    	return $this->hasMany('App\Tratamiento','ID_Trat','id');//como residuos tiene muchos tratamientos
    }

    public function SolicitudResiduo(){
        return $this->hasMany('App\SolicitudResiduo', 'ID_SolRes', 'id');//como solicitud de servicio tiene muchas solicitud de residuos
    }
}
