<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model{
    protected $table = 'activos';

	protected $fillable = ['ActName', 'ActUnid', 'ActCant', 'ActSerialProsarc', 'ActSerialProveed',' ActModel', 'ActTalla', 'ActObserv', 'FK_ActSub', 'FK_ActSede'];
	
	protected $primaryKey = 'ID_Act';

	public function Sedes(){
		return $this->belongsTo('App\Sede', 'ID_Sede');
	}
	public function SubCategoria(){
		return $this->belongsTo('App\SubcategoriaActivo', 'ID_SubCat');
	}
	public function ArticuloProv(){
		return $this->hasMany('App\ArticuloPorProveedor', 'ID_ArtiProve', 'id');//Como activos tiene muchos articulos de provedor
	}
	public function MovimientoActivo(){
		return $this->hasMany('App\MovimientoActivo.php', 'ID_MovAct', 'id');//como activo tiene muchas movimiento de active 
	}
}
