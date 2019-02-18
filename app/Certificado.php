<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model{
    protected $table='certificados';
    protected $fillable = ['CertTipo','CertNumero','CertKg','CertiEspName','CertiEspValue','CertObservacion','CertSrc','CertAnexo','FK_CertRm','FK_CertGener','FK_CertRespel'];
    protected $primaryKey = 'ID_Cert';

    public function ReciboMaterial(){
    	return $this->belogsTo('App\ReciboMaterial','Id_Rm');
    }
     public function GenerSede(){
    	return $this->belogsTo('App\GenerSede','Id_GSede');
    }
     public function ResEnvio(){
    	return $this->belogsTo('App\ResEnvio','Id_ResEnv');
    }
}
