<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model{
    protected $table='areas';
    protected $fillable = ['AreaName','AreaSede'];
    protected $primaryKey = 'ID_Area';

    public function sedes(){
    	return $this>belongsTo('App\Sede','ID_Sede');
    }
}
