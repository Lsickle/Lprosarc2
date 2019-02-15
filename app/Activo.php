<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    protected $table = 'activos';

	protected $fillable = ['ActName', 'ActUnid', 'ActCant', 'ActSerialProsarc', 'ActSerialProveed',' ActModel', 'ActTalla', 'ActObserv'];
	
	protected $primaryKey = 'ID_Act';


	public function SubcategoriaActivo()
	{
	 return $this>belongsTo('SubcategoriaActivo','ID_SubCat');
	}

}
