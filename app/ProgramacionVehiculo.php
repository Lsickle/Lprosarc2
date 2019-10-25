<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramacionVehiculo extends Model
{
    protected $table = 'progvehiculos';
    
    protected $fillable = ['ProgVehFecha', 'progVehKm', 'ProgVehTurno', 'ProgVehtipo', 'ProgVehEntrada', 'ProgVehSalida','ProgVehDelete','FK_ProgVehiculo','FK_ProgMan','FK_ProgConductor','FK_ProgAyudante', 'FK_ProgServi', 'ProgVehDocConductorEXT', 'ProgVehNameConductorEXT', 'ProgVehDocAuxiliarEXT', 'ProgVehNameAuxiliarEXT', 'ProgVehPlacaEXT', 'ProgVehTipoEXT'];

    protected $primaryKey = 'ID_ProgVeh';

    public function Vehiculo(){
        return $this->belongsTo('App\Vehiculo', 'ID_Vehic');
    }
    public function Conductor(){
        return $this->belongsTo('App\Personal', 'ID_Pers', 'FK_ProgConductor');
    }
    public function Ayudante(){
        return $this->belongsTo('App\Personal', 'ID_Pers', 'FK_ProgAyudante');
    }
    public function MantenVehics(){
        return $this->belongsTo('App\MantenimientoVehiculo', 'ID_Mv');
    }
    public function OrdenCompras()
    {
        return $this->hasMany('App\ordenCompra', 'ID_Orden', 'id');
    }
}
