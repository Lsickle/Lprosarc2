<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'Vehiculos';

    protected $fillable = ['VehicPlaca', 'VehicTipo', 'VehicCapacidad','VehicKmActual', 'VehicInternExtern', 'VehicDelete'];

    public $primaryKey = 'ID_Vehic';

    public function Sede(){
    	return $this->belongsTo('App\Sede', 'ID_Sede');
    }
    public function ProgVehiculos(){
        return $this->hasMany('App\ProgramacionVehiculo', 'ID_ProgVeh', 'id');//como vehiculo tiene muchas programaciones
    }
    public function MantVehiculos(){
        return $this->hasMany('App\MantenimientoVehiculo', 'ID_Mv', 'id');//como vehiculo tiene muchos mantenimientos
    }
}
