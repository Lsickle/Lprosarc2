<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrefacturaResiduo extends Model
{
    protected $table='prefactura_residuos';
    protected $fillable = ['precio_tarifa', 'subtotal_respel', 'cantidad_respel', 'unidad_respel', 'RMs', 'FK_PreFacTratamiento', 'FK_Prefactura'];
    protected $primaryKey = 'ID_PrefactRespel';

    public function prefactura(){
    	return $this->belongsTo('App\Prefactura','FK_Prefactura','ID_Prefactura');
    }

    public function prefacTratamiento(){
    	return $this->belongsTo('App\PrefacturaTratamiento','FK_PreFacTratamiento', 'ID_PrefacTratamiento');
    }

    public function SolicitudResiduo(){
    	return $this->belongsTo('App\SolicitudResiduo','FK_SolRespel','ID_SolRes');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'RMs' => 'array',
    ];
}
