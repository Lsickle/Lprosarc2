<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaActivo extends Model
{
    protected $table = 'categoria_activos';

	protected $fillable = ['CatName'];
	
	protected $primaryKey = 'ID_CatAct';


	public function sede()
    {
        return $this->hasMany('App\SubcategoriaActivo', 'ID_SubCat', 'id');//como categoria de activo tiene muchas sub categorias 
    }
}
