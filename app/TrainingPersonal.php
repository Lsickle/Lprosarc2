<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingPersonal extends Model{
    protected $table='training_personals';
    protected $fillable = ['FK_Sede','FK_Capa','FK_Pers'];
    protected $primaryKey = 'ID_CapPers';


	 public function sedes(){
    	return $this>belongsTo('FK_Sede','ID_Sede');
    }
    public function trainings(){
    	return $this>belongsTo('FK_Capa','ID_Capa');
    }
    public function personals(){
    	return $this>belongsTo('FK_Pers','ID_Pers');
    }
}
