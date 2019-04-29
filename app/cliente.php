<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $table = 'clientes';

	protected $fillable = ['CliNit', 'CliName', 'CliShortname', 'CliCode','CliType', 'CliCategoria','CliAuditable', 'CliSlug' ,'CliDelete', 'ID_Cli'];
	
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

	public function sedes()
    {
        return $this->hasMany('App\sede', 'ID_Sede', 'ID_Cli');//como cliente tiene muchas sedes el busca automaticamente el campo negocios_id
    }
}
