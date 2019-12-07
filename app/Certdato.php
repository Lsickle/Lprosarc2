<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certdato extends Model
{
    protected $table = 'certdato';

    protected $fillable = ['FK_DatoCert', 'FK_DatoCertSolRes'];

    protected $primaryKey = 'ID_CertDato';

    public function certificado()
    {
    	return $this->belongsTo('App\Certificado', 'FK_DatoCert', 'ID_Cert');
    }

    public function solres()
    {
    	return $this->belongsTo('App\SolicitudResiduo', 'FK_DatoCertSolRes', 'ID_SolRes');
    }
}
