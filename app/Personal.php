<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model{
    protected $table='personals';
    protected $fillable = ['PersType','PersDocType','PersDocNumber','PersFirstName','PersSecondName','PersLastName','PersEmail','PersLibreta','PersPase','PersBirthday','PersPhoneNumber','PersCellphone','PersAddress','PersEPS','PersARL','PersBank','PersBankAccaunt','PersIngreso','PersSalida','FK_PersCargo'];
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
    public function Assistence(){
        return $this->hasMany('App\Assistence', 'ID_Asis','id');//como personal tiene muchas asistencias
    }
    public function Horario(){
        return $this->hasMany('App\Horario','ID_Horario','id');//como personal tiene muchos horarios
    }
    public function InventarioTecnologiy(){
        return $this->hasMany('App\InventarioTecnologiy','Id_Tecn','id');//como personal tiene muchos inverios de tecnologia
    }
    public function ReciboMateria(){
        return $this->hasMany('App\ReciboMateria','Id_Rm','id');//como personal tiene muchos recibos de material
    }
}
