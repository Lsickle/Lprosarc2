<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model{

    protected $table='trainings';

    protected $fillable = ['CapaName','CapaTipo','CapaDelete'];
    
    protected $primaryKey = 'ID_Capa';

    public function trainings(){
    	return $this->hasMany('App\TrainingPersonal','ID_CapPers','id');//como capacitaciones tiene muchas capacitaciones de personal.
    }
}
