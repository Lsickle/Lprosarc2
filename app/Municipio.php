<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';

    protected $fillable = ['MunName'];
    
    protected $primaryKey = 'ID_Mun';

    public function Departamento(){
    	return $this->belongsTo('App\Departamento', 'FK_MunCity', 'ID_Depart');
    }
}
