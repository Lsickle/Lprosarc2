<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificado extends Model{
    protected $table='certificados';
    protected $fillable = ['CertType','CertNumero','CertiEspName','CertiEspValue','CertObservacion','CertSrc','CertSlug','CertNumRm','CertAuthHseq','CertAuthJo','CertAuthJl','CertAuthDp','CertAnexo','FK_CertSolser','FK_CertCliente','FK_CertGenerSede','FK_CertGestor','FK_CertTrat','FK_CertTransp'];
    protected $primaryKey = 'ID_Cert';

    public function SolicitudServicio(){
    	return $this->belongsTo('App\SolicitudServicio', 'FK_CertSolser', 'ID_SolSer');
    }

    public function certdato(){
    	return $this->hasMany('App\Certdato','FK_DatoCert', 'ID_Cert');
    }

    public function cliente(){
		return $this->belongsTo('App\Cliente','FK_CertCliente', 'ID_Cli');
    }

    public function sedegenerador(){
		return $this->belongsTo('App\GenerSede','FK_CertGenerSede', 'ID_GSede');
    }
    
    public function gestor(){
		return $this->belongsTo('App\Cliente','FK_CertGestor', 'ID_Cli');
    }

    public function tratamiento(){
		return $this->belongsTo('App\Tratamiento','FK_CertTrat', 'ID_Trat');
    }

    public function transportador(){
		return $this->belongsTo('App\Cliente','FK_CertTransp', 'ID_Cli');
    }
}
