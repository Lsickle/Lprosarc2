<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramacionVehiculo extends Model
{
    protected $table = 'ProgVehiculos';
    
    protected $fillable = ['ProgVehFecha', 'progVehKm', 'ProgVehTurno', 'ProgVehtipo', 'ProgVehFeriado', 'ProgVehEntrada', 'ProgVehSalida', 'HoraMantenimientoInicio', 'HoraMAntenimientoFin', 'FK_ProgVeh'];

    protected $primaryKey = 'ID_ProgVeh';
    
    public function OrdenCompras()
    {
        return $this->hasMany('App\ordenCompra', 'ID_Orden', 'id');
    }
    public function MantenVehics(){
        return $this->hasMany('App\MantenimientoVehiculo', 'ID_Mv', 'id');
    }
    public function ReciboMaterial(){
        return $this->hasMany('App\ReciboMaterial','Id_Rm','id');//como programcion de vihiculos tiene mucuhos recibos de material
    }
    // public function MantenVehics(){
    //     return $this->hasMany('App\MantenimientoVehiculo', 'ID_Mv', 'id');
    // }
}
