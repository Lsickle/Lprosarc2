<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model{
    protected $table='personals';
    protected $fillable = ['PersType','PersDocType','PersDocNumber','PersFirstName','PersSecondName','PersLastName','PersEmail','PersLibreta','PersPase','PersBirthday','PersPhoneNumber','PersCellphone','PersAddress','PersEPS','PersARL','PersBank','PersBankAccaunt','PersIngreso','PersSalida','PersDelete', 'FK_PersCargo'];
    protected $primaryKey = 'ID_Pers';

    public function cargos(){
    	return $this->belongsTo('App\Cargo','ID_Carg');
    }
    public function TrainingPersonal(){
        return $this->hasMany('App\TrainingPersonal', 'ID_CapPers', 'id');//como personal tiene muchas capacitaciones de personal 
    }
    public function MovimientoActivo(){
        return $this->hasMany('App\MovimientoActivo.php', 'ID_MovAct', 'id');//como personal tiene muchas movimiento de active 
    }
    public function SolicitudServicio(){
        return $this->hasMany('App\SolicitudServicio', 'ID_SolSer', 'id');//como personal tiene muchas Solicitudes de Servicio 
    }
    public function Assistence(){
        return $this->hasMany('App\Assistence', 'ID_Asis','id');//como personal tiene muchas asistencias
    }
    public function Horario(){
        return $this->hasMany('App\Horario','ID_Horario','id');//como personal tiene muchos horarios
    }
    public function InventarioTecnologiy(){
        return $this->hasMany('App\InventarioTecnologiy','Id_Tecn','id');//como personal tiene muchos inverios de tecnologia
    }
    public function ProgConductor(){
        return $this->hasMany('App\ProgramacionVehiculo', 'FK_ProgConductor', 'ID_Pers');
    }
    public function ProgAyudante(){
        return $this->hasMany('App\ProgramacionVehiculo', 'FK_ProgAyudante', 'ID_Pers');
    }
}
