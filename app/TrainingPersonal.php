<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingPersonal extends Model{
    protected $table='trainings';
    protected $fillable = ['FK_Sede','FK_Capa','FK_Pers'];
    protected $primaryKey = 'ID_CapPers';


	 public function cargos(){
    	return $this>belongsTo('FK_Sede','ID_Sede');
    }
    public function cargos(){
    	return $this>belongsTo('FK_Capa','ID_Capa');
    }
    public function cargos(){
    	return $this>belongsTo('FK_Pers','ID_Pers');
    }
}
