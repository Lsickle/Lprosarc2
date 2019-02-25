<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifiesto extends Model{
	protected $table='manifiestos';
    protected $fillable = ['ManifNumero','ManifKg','ManifiEspName','ManifiEspValue','ManifObservacion','ManifSrc','CertAnexo','FK_MAnifRespel','FK_MAnifRm','FK_MAnifGener','FK_ManifProvee'];
    protected $primaryKey = 'ID_Manif';

    public function SolicitudServicio(){
    	return $this->belogsTo('App\SolicitudServicio','ID_SolSer');
    }
}
