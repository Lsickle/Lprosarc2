<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'recursos';

    protected $fillable = ['RecName', 'RecCarte', 'RecTipo','RecRmSrc', 'RecSrc', 'RecFormat', 'SlugRec', 'FK_RecSol'];

    protected $primaryKey = 'ID_Rec';

    public function SolicitudResiduos()
    {
    	return $this->belongsTo('App\SolicitudResiduo', 'ID_SolRes', 'id');
    }
}
