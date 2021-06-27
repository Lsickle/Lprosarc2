<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrefacturaTratamiento extends Model
{
    protected $table='prefactura_tratamientos';
    protected $fillable = ['Subtotal_tratamiento', 'cantidad_tratamiento', 'unidad_tratamiento', 'total_prefactratamiento', 'RMs', 'FK_Prefactura', 'FK_Tratamiento'];
    protected $primaryKey = 'ID_PrefacTratamiento';

    public function prefactura(){
    	return $this->belongsTo('App\Prefactura','FK_Prefactura','ID_Prefactura');
    }
    public function tratamiento(){
    	return $this->belongsTo('App\Tratamiento','FK_Tratamiento', 'ID_Trat');
    }

    public function prefacresiduo(){
    	return $this->hasMany('App\PrefacturaResiduo', 'FK_PreFacTratamiento', 'ID_PrefacTratamiento');//Como una area tiene muchos cargos
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
