<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramacionVehiculo extends Model
{
    protected $table = 'ProgVehiculos';
    
    protected $table = ['ProgVehFecha', 'progVehKm', 'ProgVehTurno', 'ProgVehtipo', 'ProgVehFeriado', 'ProgVehEntrada', 'ProgVehSalida', 'HoraMantenimientoInicio', 'HoraMAntenimientoFin', 'FK_ProgVeh'];

    protected $primaryKey = 'ID_ProgVeh';
    
    public function OrdenCompras()
    {
        return $this->hasMany('App\ordenCompra', 'ID_Orden', 'id');
    }
}
