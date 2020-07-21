<?php
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Requerimiento extends Model
	{
		protected $table = 'requerimientos';
	
		protected $fillable = ['ReqFotoCargue', 'ReqFotoDescargue', 'ReqFotoPesaje','ReqFotoReempacado', 'ReqFotoMezclado', 'ReqFotoDestruccion', 
		'ReqVideoCargue', 'ReqVideoDescargue', 'ReqVideoPesaje', 'ReqVideoReempacado', 'ReqVideoMezclado', 'ReqVideoDestruccion', 'ReqAuditoria', 
		'ReqAuditoriaTipo', 'ReqDevolucion', 'ReqDevolucionTipo', 'ReqDatosPersonal', 'ReqPlanillas', 'ReqAlistamiento', 'ReqCapacitacion', 
		'ReqBascula', 'ReqMasPerson', 'ReqPlatform', 'ReqCertiEspecial', 'ReqSlug', 'FK_ReqTrata', 'FK_ReqRespel', 'FK_ReqTarifa', 'forevaluation'];
	
		public $primaryKey = 'ID_Req';
	
		public function respel()
		{
			return $this->belongsTo('App\Respel','FK_ReqRespel', 'ID_Respel');
		}
		
		// public function tratamientoElegido()
		// {
		// 	return $this->hasOne('App\Tratamiento', 'FK_ReqTrat', 'ID_Trat');
		// }

		public function tarifa()
		{
			return $this->hasOne('App\Tarifa', 'FK_TarifaReq', 'ID_Req');
		}

		public function tratamiento()
		{
			return $this->belongsTo('App\Tratamiento', 'FK_ReqTrata', 'ID_Trat');
		}

		//lista las pretratamientos relacionados usando muchos a muchos
		public function pretratamientosSelected()
		{
			return $this->belongsToMany('App\Pretratamiento', 'pretratamientos_requerimientos', 'FK_Req', 'FK_PreTrat');
		}

	}
