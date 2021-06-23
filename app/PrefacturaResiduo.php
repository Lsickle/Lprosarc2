<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrefacturaResiduo extends Model
{
    protected $table='prefactura_residuos';
    protected $fillable = ['precio_tarifa', 'subtotal_respel', 'cantidad_respel', 'unidad_respel', 'RMs', 'FK_PreFacTratamiento', 'FK_Prefactura'];
    protected $primaryKey = 'ID_PrefacTratamiento';

    public function prefactura(){
    	return $this->belongsTo('App\Prefactura','FK_Prefactura','ID_Prefactura');
    }
    public function tratamiento(){
    	return $this->belongsTo('App\Tratamiento','FK_PreFacTratamiento', 'ID_Trat');
    }
}
