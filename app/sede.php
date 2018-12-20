<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sede extends Model
{
    protected $table='sedes';

    protected $fillable['SedeName','SedeAddress','SedePhone1','SedeExt1', 'SedePhone2','SedeExt2', 'SedeEmail', 'SedeCelular', 'Cliente', 'SedeSlug'];

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

	// public function clientes(){
	//  return 
	// $this>belongsTo(
	// 'App\cliente','ID_Cli')
	// }

}
