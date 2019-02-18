<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
	protected $table = 'clientes';

	protected $fillable = ['CliNit', 'CliName', 'CliShortname', 'CliCode','CliType', 'CliCategoria','CliAuditable', 'CliSlug'];
	
	protected $primaryKey = 'ID_Cli';
	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'CliSlug';
	}

	public function sede()
    {
        return $this->hasMany('App\sede', 'ID_Sede', 'id');//como cliente tiene muchas sedes el busca automaticamente el campo negocios_id
    }
    public function ReciboMaterial(){
    	return $this->hasMany('App\ReciboMaterial','Id_Rm','id');//como clientes tienen muchos recibos de material
	}
	
	public  function Tratamientos(){
        return $this->hasMany('App\Tratamiento', 'ID_Trat', 'id');//como cliente puede proveher muchos residuos
    }
}
