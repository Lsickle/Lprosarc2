<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifiesto extends Model{
	protected $table='manifiestos';
    protected $fillable = ['ManifNumero','ManifiEspName','ManifiEspValue','ManifObservacion','ManifSrc','ManiAuthJo','ManiAuthJl','ManiAuthDp','CertAnexo'];
    protected $primaryKey = 'ID_Manif';

    public function SolicitudServicio(){
    	return $this->belogsTo('App\SolicitudServicio','ID_SolSer');
    }
}
