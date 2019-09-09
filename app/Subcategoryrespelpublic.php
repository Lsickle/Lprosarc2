<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoryrespelpublic extends Model
{
    protected $table = 'subcategoryrespelpublic';

	protected $fillable = ['SubCategoryRpName'];
	
	protected $primaryKey = 'ID_SubCategoryRP';


	public function SubcategoryRespelpublic()
    {
        return $this->belongsTo('App\Categoryrespelpublic', 'FK_CategoryRP', 'ID_CategoryRP');//como categoria de activo tiene muchas sub categorias 
    }

    public function respelsPublic()
    {
        return $this->hasMany('App\Respelpublic', 'FK_SubCategoryRP', 'ID_CategoryRP');
    }

}
