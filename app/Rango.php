<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rango extends Model
{
    protected $table = 'rangos';

    protected $fillable = ['TarifaPrecio', 'TarifaDesde', 'FK_RangoTarifa'];

    protected $primaryKey = 'ID_Rango';

    public function tarifa()
    {
    	return $this->belongsTo('App\Tarifa', 'FK_RangoTarifa', 'ID_Tarifa');
    }
}
