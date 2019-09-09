<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requerimientorespelpublic extends Model
{
    protected $table='requerimientopublic';

	protected $fillable=['PReqFotoDescargue','PReqFotoPesaje','PReqFotoDestruccion','PReqVideoCargue','PReqVideoDescargue','PReqVideoPesaje','PReqVideoReempacado','PReqVideoMezclado','PReqVideoDestruccion','PReqAuditoria','PReqAuditoriaTipo','PReqFotoCargue','PReqDevolucion','PReqDevolucionTipo','PReqDatosPersonal','PReqPlanillas','PReqAlistamiento','PReqCapacitacion','PReqCertiEspecial','PReqSlug','Pofertado','FK_PReqTrata','FK_PRespel'];

	protected $primaryKey = 'ID_PReq';
		/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function Respelpublic()
		{
			return $this->belongsTo('App\Respelpublic', 'FK_PRespel', 'ID_PReq');
		}
		
		public function Tratamiento()
		{
			return $this->belongsTo('App\Tratamiento', 'FK_PReqTrata', 'ID_Trat');
		}

}
