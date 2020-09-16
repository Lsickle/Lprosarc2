<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table='sedes';

    protected $fillable=['SedeName', 'SedeAddress', 'SedePhone1', 'SedeExt1', 'SedePhone2','SedeExt2', 'SedeEmail', 'SedeCelular', 'SedeSlug', 'FK_SedeCli', 'FK_SedeMun','SedeDelete'];

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
	 return $this->belongsTo('App\Cliente','FK_SedeCli', 'ID_Cli');
	}
	public function Municipios()
	{
	 return $this->belongsTo('App\Municipio', 'FK_SedeMun', 'ID_Mun');
	}
	public function generador(){
        return $this->hasMany('App\Generador', 'FK_GenerCli', 'ID_Sede');//como sede tiene muchas generadores el busca automaticamente el campo negocios_id
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
    	return $this->hasMany('App\Area', 'FK_AreaSede', 'ID_Sede'); //como sedes tiene muchas areas
    }
    public function Tratamiento(){
    	return $this->hasMany('App\Tratamiento','ID_Trat','id');//como sedes tiene muchos tratamientos
    }
    public function Activo(){
    	return $this->hasMany('App\Activo', 'ID_Act', 'id');//como sedes tiene muchos activos
	}
	public function Cotizacion(){
    	return $this->hasMany('App\Cotizacion', 'ID_Coti', 'id');//como sedes tiene muchas cotizaciones

    	// return $this->hasManyThrough(
     //        'App\Respel',
     //        'App\Cotizacion',
     //        'FK_RespelCoti', // Foreign key on users table...
     //        'FK_CotiSede', // Foreign key on posts table...
     //        'ID_Respel', // Local key on countries table...
     //        'ID_Coti' // Local key on users table...
     //    );
    }
}
