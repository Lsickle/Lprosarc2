<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoryrespelpublic extends Model
{
    protected $table = 'categoryrespelpublic';

	protected $fillable = ['CategoryRpName'];
	
	protected $primaryKey = 'ID_CategoryRP';


	public function SubcategoryRespelpublic()
    {
        return $this->hasMany('App\Subcategoryrespelpublic', 'ID_SubCategoryRP', 'ID_CategoryRP');//como categoria de activo tiene muchas sub categorias 
    }

}
