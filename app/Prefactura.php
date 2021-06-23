<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefactura extends Model
{
    protected $table='areas';
    protected $fillable = ['AreaName'];
    protected $primaryKey = 'ID_Area';

    public function sede(){
    	return $this->belongsTo('App\Sede','FK_AreaSede','ID_Sede');
    }
    public function GenerSedes(){
    	return $this->belongsTo('App\GenerSede','ID_GSede');
    }
    public function Cargos(){
    	return $this->hasMany('App\Cargo', 'CargArea', 'ID_Area');//Como una area tiene muchos cargos
    }
}
