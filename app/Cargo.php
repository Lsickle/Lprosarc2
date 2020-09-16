<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model{
    protected $table = 'cargos';
    protected $fillable = ['CargName','CargSalary','CargGrade','CargDelete','CargArea'];
    protected $primaryKey = 'ID_Carg';

    public function area(){
    	return $this->belongsTo('App\Area','CargArea','ID_Area');
    }
    public function Personal(){
    	return $this->hasMany('App\Personal', 'FK_PersCargo', 'ID_Carg');//como cargos tiene mucho personal
    }
}
