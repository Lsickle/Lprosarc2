<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generador extends Model
{
    protected $table = 'generadors';

	protected $fillable = ['GenerNit', 'GenerName', 'GenerShortname', 'GenerCode', 'GenerType','GenerAuditable', 'GenerSlug', 'GenerCli'];
	
	protected $primaryKey = 'ID_Gener';
	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'GenerSlug';
	}
	public function sedes()
	{
	 return $this>belongsTo('App\Sede', 'ID_Sede');//como generador pertenece a la sede de un cliente
	}
	public function GenerSede()
    {
        return $this->hasMany('App\GenerSede', 'ID_GSede', 'id');//como generador tiene muchas sedes de generador // el busca automaticamente el campo ID_GSede
    }
}
