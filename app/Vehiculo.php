<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'Vehiculos';

    protected $fillable = ['VehicPlaca', 'VehicTipo', 'VehicCapacidad','VehicKmActual', 'VehicInternExtern', 'FK_VehiSede'];

    public $primaryKey = 'ID_Vehic';

    public function ProgVehiculos(){
        return $this->hasMany('App\ProgramacionVehiculo', 'ID_ProgVeh', 'id');
    }

}
