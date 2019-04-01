<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoActivo extends Model
{
    protected $table = 'movimiento_activos';

	protected $fillable = ['MovTipo', 'FK_MovInv', 'FK_ActPerson', 'MovActDelete'];
	
	protected $primaryKey = 'ID_MovAct';
	
	public function Activo()
	{
	 return $this->belongsTo('App\Activo', 'ID_Act');//como movimiento_activos depende de un activo
	}
	public function Personal()
	{
	 return $this->belongsTo('App\Personal', 'ID_Pers');//como movimiento_activos puede estar relacionado con Personal
	}
}
