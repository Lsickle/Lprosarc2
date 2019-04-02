<?php
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Requerimiento extends Model
	{
		protected $table = 'requerimientos';
	
		protected $fillable = ['ReqFotoCargue', 'ReqFotoDescargue', 'ReqFotoPesaje','ReqFotoReempacado', 'ReqFotoMezclado', 'ReqFotoDestruccion', 
		'ReqVideoCargue', 'ReqVideoDescargue', 'ReqVideoPesaje', 'ReqVideoReempacado', 'ReqVideoMezclado', 'ReqVideoDestruccion', 'ReqAuditoria', 
		'ReqAuditoriaTipo', 'ReqDevolucion', 'ReqDevolucionTipo', 'ReqDatosPersonal', 'ReqPlanillas', 'ReqAlistamiento', 'ReqCapacitacion', 
		'ReqBascula', 'ReqMasPerson', 'ReqPlatform', 'ReqCertiEspecial', 'ReqSlug', 'FK_ReqTarifa'];
	
		public $primaryKey = 'ID_Req';
	
		public function Respels()
		{
			return $this->belongsTo('App\Respel', 'ID_Respel', 'id');
		}

		public function Tarifa()
		{
			return $this->belongsTo('App\Tarifa', 'FK_ReqTarifa', 'ID_Tarifa');
		}
	}
