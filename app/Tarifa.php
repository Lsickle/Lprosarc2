<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $table = 'tarifas';

    protected $fillable= ['TarifaVencimiento', 'TarifaFrecuencia', 'Tarifatipo', 'FK_TarifaReq', 'TarifaSpecial'];

    protected $primaryKey = 'ID_Tarifa';

    public function requerimiento(){
    	return $this->belongsTo('App\Requerimiento', 'ID_Req', 'FK_TarifaReq');
    }

    public function rangos(){
    	return $this->hasMany('App\Rango', 'FK_RangoTarifa', 'ID_Tarifa');
    }
 //    public function respel()
	// {
	//     return $this->belongsToMany('App\Respel', 'respel_tarifa', 'FK_Tarifa', 'FK_Respel')
	//     ->withPivot('FK_Respel');
	// }
}
