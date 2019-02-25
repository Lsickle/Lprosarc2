<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MantenimientoVehiculo extends Model
{
    protected $table = 'MantenVehics'; 

    protected $filatable = ['MvKm', 'MvStatus', 'MvType', 'HoraMavInicio', 'HoraMavFin'];

    protected $primarykey = 'ID_Mv';

    public function Vehiculo(){
    	return $this->belongsTo('App\Vehiculo', 'ID_Vehic');
    }
}
