<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model{
    protected $table='areas';
    protected $fillable = ['AreaName'];
    protected $primaryKey = 'ID_Area';

    public function Sedes(){
    	return $this->belongsTo('App\Sede','ID_Sede');
    }
    public function GenerSedes(){
    	return $this->belongsTo('App\GenerSede','ID_GSede');
    }
    public function Cargos(){
    	return $this->hasMany('App\Cargo', 'ID_Carg', 'id');//Como una area tiene muchos cargos
    }
}
