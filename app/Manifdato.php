<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifdato extends Model
{
    protected $table = 'manifdato';

    protected $fillable = ['FK_DatoManif', 'FK_DatoManifSolRes'];

    protected $primaryKey = 'ID_ManifDato';

    public function manifiesto()
    {
    	return $this->belongsTo('App\Manifiesto', 'FK_DatoManif', 'ID_Manif');
    }

    public function solres()
    {
    	return $this->belongsTo('App\SolicitudResiduo', 'FK_DatoManifSolRes', 'ID_SolRes');
    }
}
