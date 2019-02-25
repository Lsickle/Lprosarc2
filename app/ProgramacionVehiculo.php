<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramacionVehiculo extends Model
{
    protected $table = 'ProgVehiculos';
    
    protected $fillable = ['ProgVehFecha', 'progVehKm', 'ProgVehTurno', 'ProgVehtipo', 'ProgVehEntrada', 'ProgVehSalida'];

    protected $primaryKey = 'ID_ProgVeh';

    public function Vehiculo(){
        return $this->belongsTo('App\Vehiculo', 'ID_Vehic');
    }
    public function Personal(){
        return $this->belongsTo('App\Personal', 'ID_Pers');
    }
    public function MantenVehics(){
        return $this->belongsTo('App\MantenimientoVehiculo', 'ID_Mv');
    }
    public function OrdenCompras()
    {
        return $this->hasMany('App\ordenCompra', 'ID_Orden', 'id');
    }
}
