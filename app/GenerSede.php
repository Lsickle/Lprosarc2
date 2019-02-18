<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenerSede extends Model
{
    protected $table='gener_sedes';

    protected $fillable=['GSedeName', 'GSedeAddress', 'GSedePhone1', 'GSedeExt1', 'GSedePhone2',' GSedeExt2', 'GSedeEmail', 'GSedeCelular', 'Generador', 'GSedeSlug'];

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
	 return $this>belongsTo('App\Generador', 'ID_Gener');
	}
	public function declaracion()
    {
        return $this->hasMany('App\Declaration', 'ID_Declar');//como sede tiene muchas generadores el busca automaticamente el campo negocios_id
    }

	// public function generador()
 //    {
 //        return $this->hasMany('generador', 'ID_Gener');//como sede tiene muchas generadores el busca automaticamente el campo negocios_id
 //    }
}
