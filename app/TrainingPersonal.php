<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingPersonal extends Model{

    protected $table = 'training_personals';}

    protected $fillable = ['CapaPersDate', 'CapaPersExpire'];

    protected $primaryKey = 'ID_CapPers';


	 public function sedes(){
    	return $this->belongsTo('App\Sede','ID_Sede');
    }
    public function trainings(){
    	return $this->belongsTo('App\Training','ID_Capa');
    }
    public function personals(){
    	return $this->belongsTo('App\Personal','ID_Pers');
    }
}
