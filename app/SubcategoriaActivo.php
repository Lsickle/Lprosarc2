<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubcategoriaActivo extends Model
{
    protected $table = 'subcategoria_activos';

	protected $fillable = ['SubCatName'];
	
	protected $primaryKey = 'ID_SubCat';


	public function CategoriaActivo()
	{
	 return $this>belongsTo('App\CategoriaActivo','ID_CatAct');
	}

	public function Activo()
    {
        return $this->hasMany('App\Activo', 'ID_Act', 'id');//como Subcategorias tiene muchos activos
    }
}
