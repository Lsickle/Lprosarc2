<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudServicio extends Model
{
    protected $table='solicitud_servicios';

    protected $fillable=['SolSerStatus', 'SolSerTipo', 'SolSerFrecuencia',' SolSerAuditable', 'SolSerConducExter','SolSerVehicExter', 'SolSerSlug', 'Fk_SolSerTransportador', 'FK_SolSerCliente', 'FK_SolSerPersona','SolSerDelete', 'created_at', 'updated_at'];
    protected $primaryKey = 'ID_SolSer';
    	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'SolSerSlug';
	}
	// especificar foranea del modelo sede
	public function sedes()
	{
	 return $this->belongsTo('App\Sede', 'ID_Sede');
	}
	// especificar foranea del modelo GenerSede
	public function GenerSedes()
	{
	 return $this->belongsTo('App\GenerSede', 'ID_GSede');
	}
	public function Personal()
	{
	 	return $this->belongsTo('App\Personal', 'ID_Pers');
	}
	public function Certificado(){
		return $this->hasMany('App\Certificado','ID_Cert','id');//como solicitud de servicio tiene muchos certificados
	}
	public function Manifiesto(){
		return $this->hasMany('App\Manifiesto','ID_Manif', 'id');//como solicitud de servicio tiene muchos manifiestos
	}
	public function SolicitudResiduo(){
		return $this->hasMany('App\SolicitudResiduo', 'ID_SolRes', 'id');//como solicitud de servicio tiene muchas solicitud de residuos
	}
	public function ResiduosGener(){
		return $this->hasMany('App\ResiduosGener', 'ID_SGenerRes', 'id');
	}
	public function ManifiestoCarga(){
		return $this->hasMany('App\ManifiestoCarga','ID_ManiCarg','id');//como solicitud de servicio tiene muchos manifiesto de carga
	}
}
