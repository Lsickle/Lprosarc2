<?php
	namespace App;
	
	use Illuminate\Database\Eloquent\Model;
	
	class Requerimiento extends Model
	{
		protected $table = 'requerimientos';
	
		protected $fillable = ['ReqFotoCargue', 'ReqFotoDescargue', 'ReqFotoPesaje','ReqFotoReempacado', 'ReqFotoMezclado', 'ReqFotoDestruccion', 
		'ReqVideoCargue', 'ReqVideoDescargue', 'ReqVideoPesaje', 'ReqVideoReempacado', 'ReqVideoMezclado', 'ReqVideoDestruccion', 'ReqAuditoria', 
		'ReqAuditoriaTipo', 'ReqDevolucion', 'ReqDevolucionTipo', 'ReqDatosPersonal', 'ReqPlanillas', 'ReqAlistamiento', 'ReqCapacitacion', 
		'ReqBascula', 'ReqMasPerson', 'ReqPlatform', 'ReqCertiEspecial', 'ReqSlug', 'FK_ReqTrata', 'FK_ReqRespel'];
	
		public $primaryKey = 'ID_Req';
	
		public function Respel()
		{
			return $this->belongsTo('App\Respel','FK_ReqRespel', 'ID_Respel');
		}
		public function Tratamiento()
		{
			return $this->belongsTo('App\Respel', 'FK_ReqTrata', 'ID_Trat');
		}
	}
