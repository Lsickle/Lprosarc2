<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docdato extends Model
{
    protected $table = 'doc_dato';

    protected $fillable = ['FK_DatoDoc', 'FK_DatoSolRes'];

    protected $primaryKey = 'ID_Dato';

    public function documento()
    {
    	return $this->belongsTo('App\Documento', 'FK_DatoDoc', 'ID_Doc');
    }

    public function solres()
    {
    	return $this->belongsTo('App\SolicitudResiduo', 'FK_DatoSolRes', 'ID_SolRes');
    }
}
