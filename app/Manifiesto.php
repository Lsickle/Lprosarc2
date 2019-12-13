<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifiesto extends Model{
	protected $table='manifiestos';

    protected $fillable = ['ManifType','ManifNumero','ManifiEspName','ManifiEspValue','ManifObservacion','ManifSrc','ManifSlug','ManifNumRm','ManifAuthHseq','ManiAuthJo','ManiAuthJl','ManiAuthDp','CertAnexo','FK_ManifSolser','FK_ManifCliente','FK_ManifGenerSede','FK_ManifGestor','FK_ManifTrat','FK_ManifTransp'];

    protected $primaryKey = 'ID_Manif';

    public function SolicitudServicio(){
    	return $this->belongsTo('App\SolicitudServicio','FK_ManifSolser','ID_SolSer');
    }

    public function manifdato(){
    	return $this->hasMany('App\Manifdato','FK_DatoManif', 'ID_Manif');
    }

    public function cliente(){
		return $this->belongsTo('App\Cliente','FK_ManifCliente', 'ID_Cli');
    }

    public function sedegenerador(){
		return $this->belongsTo('App\GenerSede','FK_ManifGenerSede', 'ID_GSede');
    }
    
    public function gestor(){
		return $this->belongsTo('App\Cliente','FK_ManifGestor', 'ID_Cli');
    }

    public function tratamiento(){
		return $this->belongsTo('App\Tratamiento','FK_ManifTrat', 'ID_Trat');
    }

    public function transportador(){
		return $this->belongsTo('App\Cliente','FK_ManifTransp', 'ID_Cli');
    }
}
