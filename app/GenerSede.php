<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenerSede extends Model
{
    protected $table='gener_sedes';

    protected $fillable=['GSedeName', 'GSedeAddress', 'GSedePhone1', 'GSedeExt1', 'GSedePhone2',' GSedeExt2', 'GSedeEmail', 'GSedeCelular', 'Generador', 'GSedeSlug', 'FK_GSede', 'FK_GSedeMun', 'GSedeDelete'];

    protected $primaryKey = 'ID_GSede';
    	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'GSedeSlug';
	}
	public function generadors()
	{
	 return $this->belongsTo('App\Generador', 'ID_Gener');
	}
	public function SolicitudServicio()
    {
        return $this->hasMany('App\SolicitudServicio', 'ID_SolSer');//como genersede tiene muchas solicitudes de servicio
    }
    public function Areas(){
    	return $this->hasMany('App\GenerSede', 'ID_Area', 'id');//como genersedes tiene muchas areas
    }
}
