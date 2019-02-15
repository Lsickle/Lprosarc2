<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'Vehiculos';

    protected $table = ['VehicPlaca', 'VehicTipo', 'VehicCapacidad','VehicKmActual', 'VehicInternExtern' 'FK_VehiSede'];

    public $primaryKey = 'ID_Vehic';
}
