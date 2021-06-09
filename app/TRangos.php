<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TRangos extends Model
{
    protected $table = 'rangostarifa';

    protected $fillable = ['CTarifaPrecio', 'CTarifaDesde', 'FK_RangoCTarifa'];

    protected $primaryKey = 'ID_CRango';

    public function tarifa()
    {
    	return $this->belongsTo('App\CTarifa', 'FK_RangoTarifa', 'ID_CTarifa');
    }
}
