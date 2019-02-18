<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table='sedes';

    protected $fillable=['SedeName', 'SedeAddress', 'SedePhone1', 'SedeExt1', 'SedePhone2',' SedeExt2', 'SedeEmail', 'SedeCelular', 'Cliente', 'SedeSlug'];

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
	 return $this>belongsTo('App\Cliente','ID_Cli');
	}

	public function generador()
    {
        return $this->hasMany('App\generador', 'ID_Gener', 'id');//como sede tiene muchas generadores el busca automaticamente el campo negocios_id
	}
	
    public function declaracion()
    {
        return $this->hasMany('App\Declaration', 'ID_Declar', 'id');//como sede tiene muchas generadores el busca automaticamente el campo negocios_id
	}
	
	public function Quotations()
    {
        return $this->hasMany('App\Quotation', 'ID_Cotiz', 'id');//sede tiene muchas cotizaciones
    }
    public function trainings(){
    	return $this>hasMany('App\TrainingPersonal','ID_CapPers','id');//como sedes tiene muchas capacitaciones de personal.
    }
    public function Manifiesto(){
    	return $this>hasMany('App\Manifiesto','ID_ID_Manif','id');//como sedes tiene muchos manifiestos
    }
}
