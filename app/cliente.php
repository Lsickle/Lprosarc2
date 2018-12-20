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
        return $this->hasMany('sede', 'ID_Sede');//como cliente tiene muchas sedes el busca automaticamente el campo negocios_id
    }
}
