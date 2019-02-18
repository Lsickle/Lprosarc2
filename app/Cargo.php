<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model{
    protected $table = 'Cargos';
    protected $fillable = ['CargName','CargSalary','CargGrade','CargOfi'];
    protected $primaryKey = 'ID_Carg';

    public function oficces(){
    	return $this>belongsTo('App\Area','ID_Area');
    }
}
