<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifiesto extends Model{
	protected $table='manifiestos';
    protected $fillable = ['ManifNumero','ManifKg','ManifiEspName','ManifiEspValue','ManifObservacion','ManifSrc','CertAnexo','FK_MAnifRespel','FK_MAnifRm','FK_MAnifGener','FK_ManifProvee'];
    protected $primaryKey = 'ID_Manif';


    public function ResEnvio(){
    	return $this->belogsTo('App\ResEnvio','ID_ResEnv');
    }
    public function ReciboMaterial(){
    	return $this->belogsTo('App\ReciboMaterial','ID_Rm');
    }
     public function GenerSede(){
    	return $this->belogsTo('App\GenerSede','ID_GSede');
    }
     public function Sede(){
    	return $this->belogsTo('App\Sede','ID_Sede');
    }
}
