<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertExpressdato extends Model
{
    protected $table = 'certexpressdato';

    protected $fillable = ['FK_DatoCert', 'FK_DatoCertSolRes'];

    protected $primaryKey = 'ID_CertDato';

    public function certificado()
    {
    	return $this->belongsTo('App\CertificadoExpress', 'FK_DatoCert', 'ID_Cert');
    }

    public function solres()
    {
    	return $this->belongsTo('App\SolicitudResiduo', 'FK_DatoCertSolRes', 'ID_SolRes');
    }
}
