<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model{
    protected $table='certificados';
    protected $fillable = ['CertNumero','CertiEspName','CertiEspValue','CertObservacion','CertSrc','CertAuthJo','CertAuthJl','CertAuthDp','CertAnexo'];
    protected $primaryKey = 'ID_Cert';

    public function SolicitudServicio(){
    	return $this->belogsTo('App\SolicitudServicio','ID_SolSer');
    }
}
