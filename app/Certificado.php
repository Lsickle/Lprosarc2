<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model{
    protected $table='certificados';
    protected $fillable = ['CertType','CertNumero','CertiEspName','CertiEspValue','CertObservacion','CertSrc','CertSlug','CertNumRm','CertAuthHseq','CertAuthJo','CertAuthJl','CertAuthDp','CertAnexo','FK_CertSolser','FK_CertCliente','FK_CertGenerSede','FK_CertGestor','FK_CertTrat','FK_CertTransp'];
    protected $primaryKey = 'ID_Cert';

    public function SolicitudServicio(){
    	return $this->belogsTo('App\SolicitudServicio', 'FK_CertSolser', 'ID_SolSer');
    }

    public function certdato(){
    	return $this->hasMany('App\Certdato','FK_DatoCert', 'ID_Cert');
    }
}
