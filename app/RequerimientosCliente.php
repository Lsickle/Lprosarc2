<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimientosCliente extends Model
{
	protected $table='requerimientos_clientes';

	protected $fillable=['RequeCliBascula', 'RequeCliCapacitacion', 'RequeCliMasPerson', 'RequeCliVehicExclusive', 'RequeCliPlatform', 'FK_RequeClient'];

	protected $primaryKey = 'ID_RequeCli';
		/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
		return 'ID_RequeCli';
	}
	public function clientes()
	{
	 return $this->belongsTo('App\Cliente','FK_RequeClient', 'ID_Cli');
	}
}
 