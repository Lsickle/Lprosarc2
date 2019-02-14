<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model{
    protected $table='areas';
    protected $fillable = ['AreaName','AreaSede'];
    protected $primaryKey = 'ID_Area';

    public function sedes(){
    	return $this>belongsTo('AreaSede','ID_Sede');
    }
}
