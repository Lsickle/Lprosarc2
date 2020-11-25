<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    protected $table='observacions';
    protected $fillable = ['ObsStatus','ObsMensaje','ObsTipo','ObsRepeat','ObsDate','ObsUser','ObsRol','FK_ObsSolSer'];
    protected $primaryKey = 'ID_Obs';

    public function servicio(){
    	return $this->belongsTo('App\SolicitudServicio','FK_ObsSolSer', 'ID_SolSer');
    }
}
