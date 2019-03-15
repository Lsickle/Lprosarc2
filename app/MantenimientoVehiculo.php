<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MantenimientoVehiculo extends Model
{
    protected $table = 'mantenvehics'; 

    protected $fillable = ['MvKm', 'HoraMavInicio', 'HoraMavFin', 'MvType', 'FK_VehMan','MvDelete'];

    protected $primaryKey = 'ID_Mv';

    public function Vehiculo(){
    	return $this->belongsTo('App\Vehiculo', 'ID_Vehic');
    }
}
