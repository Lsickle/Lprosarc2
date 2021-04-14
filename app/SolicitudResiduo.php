<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudResiduo extends Model{

    protected $table = 'solicitud_residuos';

    protected $fillable = ['SolResKgEnviado', 'SolResKgRecibido', 'SolResKgConciliado', 'SolResKgTratado', 'SolResDelete', 'SolResSlug', 'FK_SolResSolSer', 'SolResTypeUnidad', 'SolResCantiUnidad', 'SolResEmbalaje', 'SolResAlto', 'SolResAncho', 'SolResProfundo', 'SolResFotoDescargue_Pesaje', 'SolResFotoTratamiento', 'SolResVideoDescargue_Pesaje', 'SolResVideoTratamiento', 'SolResDevolucion', 'SolResDevolCantidad', 'FK_SolResRequerimiento', 'FK_SolResRg', 'SolResAuditoria', 'SolResAuditoriaTipo', 'SolResRM'];
   
    protected $primaryKey = 'ID_SolRes';

    public function SolicitudServicio(){
    	return $this->belongsTo('App\SolicitudServicio', 'FK_SolResSolSer', 'ID_SolSer');
    }

    // public function Respel(){
    // 	return $this->belogsTo('App\Respel', 'ID_Respel');
    // }

    public function generespel(){
    	return $this->belongsTo('App\ResiduosGener', 'FK_SolResRg', 'ID_SGenerRes');
    }

    public function docdato()
    {
    	return $this->hasOne('App\Docdato', 'FK_DatoSolRes', 'ID_SolRes');
    }

    public function requerimiento()
    {
    	return $this->belongsTo('App\Requerimiento', 'FK_SolResRequerimiento', 'ID_Req');
    }

    public function certdato()
    {
    	return $this->hasOne('App\Certdato', 'FK_DatoCertSolRes', 'ID_SolRes');
    }

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'SolResRM' => 'array',
    ];
}

