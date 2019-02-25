<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model{
	protected $table='horarios';
    protected $fillable = ['HorarioFecha','Horariotipo','HorariotipoOther','HorarioFeriado','HorarioEntrada','HorarioSalida','HoraPermisoInicio','HoraPermisoFin'];
    protected $primaryKey = 'ID_Horario';

    public function personals(){
    	return $this->belongsTo('App\Personal','ID_Pers');
    }
}
