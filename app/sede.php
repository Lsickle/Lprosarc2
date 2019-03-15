<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table='sedes';

    protected $fillable=['SedeName', 'SedeAddress', 'SedePhone1', 'SedeExt1', 'SedePhone2',' SedeExt2', 'SedeEmail', 'SedeCelular', 'SedeSlug', 'FK_SedeCli', 'FK_SedeMun','SedeDelete'];

    protected $primaryKey = 'ID_Sede';
    	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'SedeSlug';
	}
	public function clientes()
	{
	 return $this->belongsTo('App\Cliente','ID_Cli');
	}
	public function Municipios()
	{
	 return $this->belongsTo('App\Municipio','ID_Mun');
	}
	public function generador(){
        return $this->hasMany('App\generador', 'ID_Gener', 'id');//como sede tiene muchas generadores el busca automaticamente el campo negocios_id
	}
    public function SolicitudServicio(){
        return $this->hasMany('App\SolicitudServicio', 'ID_SolSer', 'id');//como sede tiene muchas solicitudes de servicio
	}
	public function Quotations(){
        return $this->hasMany('App\Quotation', 'ID_Cotiz', 'id');//sede tiene muchas cotizaciones
	}
    public function trainings(){
    	return $this->hasMany('App\TrainingPersonal','ID_CapPers','id');//como sedes tiene muchas capacitaciones de personal.
	}
	public function Vehiculos(){
        return $this->hasMany('App\Vehiculo', 'ID_Vehic', 'id');//como sedes tiene muchos vehiculos
    }
    public function Manifiesto(){
    	return $this->hasMany('App\Manifiesto','ID_ID_Manif','id');//como sedes tiene muchos manifiestos
    }
    public function Areas(){
    	return $this->hasMany('App\Area', 'ID_Area', 'id'); //como sedes tiene muchas areas
    }
    public function Tratamiento(){
    	return $this->hasMany('App\Tratamiento','ID_Trat','id');//como sedes tiene muchos tratamientos
    }
    public function Activo(){
    	return $this->hasMany('App\Activo', 'ID_Act', 'id');//como sedes tiene muchos activos
	}
	public function Respel(){
    	return $this->hasMany('App\Respel', 'ID_Respel', 'id');//como genersedes tiene muchas areas
    }
}
