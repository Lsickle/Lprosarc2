<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudResiduo extends Model{

    protected $table = 'solicitud_residuos';

    protected $fillable = ['SolResCateEnviado', 'SolResCateRecibido', 'SolResCateConciliado', 'SolResCateTratado', 'SolResUnidades', 'SolResDelete', 'SolResSlug', 'SolResFotoCargue', 'SolResFotoDescargue', 'SolResFotoPesaje', 'SolResFotoReempacado', 'SolResFotoMezclado', 'SolResFotoDestruccion', 'SolResVideoCargue', 'SolResVideoDescargue', 'SolResVideoPesaje', 'SolResVideoReempacado', 'SolResVideoMezclado', 'SolResVideoDestruccion', 'SolResAuditoria', 'SolResAuditoriaTipo', 'SolResDevolucion', 'SolResDevolucionTipo', 'SolResDatosPersonal', 'SolResPlanillas', 'SolResAlistamiento', 'SolResCapacitacion', 'SolResBascula', 'SolResMasPerson', 'SolResPlatform', 'SolResCertiEspecial', 'SolResTipoCate', 'FK_SolResTratamiento', 'FK_SolResRg', 'FK_SolResSolSer'];
   
    protected $primaryKey = 'ID_SolRes';

    public function SolicitudServicio(){
    	return $this->belogsTo('App\SolicitudServicio','ID_SolSer');
    }
    public function Respel(){
    	return $this->belogsTo('App\Respel', 'ID_Respel');
    }
}

