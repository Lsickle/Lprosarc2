<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramacionVehiculo extends Model
{
    protected $table = 'progvehiculos';
    
    protected $fillable = ['ProgVehFecha', 'progVehKm', 'ProgVehTurno', 'ProgVehtipo', 'ProgVehEntrada', 'ProgVehSalida','ProgVehDelete','FK_ProgVehiculo','FK_ProgMan','FK_ProgConductor','FK_ProgAyudante', 'FK_ProgServi', 'ProgVehDocConductorEXT', 'ProgVehNameConductorEXT', 'ProgVehDocAuxiliarEXT', 'ProgVehNameAuxiliarEXT', 'ProgVehPlacaEXT', 'ProgVehTipoEXT', 'ProgVehStatus', 'ProgVehPrecintos', 'ProgVehExclusive'];

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

    public function puntosderecoleccion()
    {
        return $this->belongsToMany('App\GenerSede', 'recolect', 'FK_ColectProg', 'FK_ColectSgen');
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'ProgVehPrecintos' => 'array',
    ];


    public function servicio()
    {
        return $this->belongsTo('App\SolicitudServicio', 'FK_ProgServi', 'ID_SolSer');
    }
}
