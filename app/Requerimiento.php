<?php
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Recurso extends Model
	{
		protected $table = 'requerimientos';
	
		protected $fillable = ['ReqFotoCargue', 'ReqFotoDescargue', 'ReqFotoPesaje','ReqFotoReempacado', 'ReqFotoMezclado', 'ReqFotoDestruccion', 
		'ReqVideoCargue', 'ReqVideoDescargue', 'ReqVideoPesaje', 'ReqVideoReempacado', 'ReqVideoMezclado', 'ReqVideoDestruccion', 'ReqAuditoria', 
		'ReqAuditoriaTipo', 'ReqDevolucion', 'ReqDevolucionTipo', 'ReqDatosPersonal', 'ReqPlanillas', 'ReqAlistamiento', 'ReqCapacitacion', 
		'ReqBascula', 'ReqMasPerson', 'ReqPlatform', 'ReqCertiEspecial', 'ReqSlug'];
	
		public $primaryKey = 'ID_Rec';
	
		public function Respels()
		{
			return $this->belongsTo('App\Respel', 'ID_Respel', 'id');
		}
	}
