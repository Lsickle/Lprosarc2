<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respelpublic extends Model
{
    protected $table='respelpublic';

    protected $fillable=['PRespelName', 'PRespelDescrip', 'PYRespelClasf4741', 'PARespelClasf4741', 'PRespelIgrosidad', 'PRespelEstado', 'PRespelHojaSeguridad', 'PRespelTarj', 'PRespelStatus','PRespelDelete', 'PRespelSlug', 'PRespelStatusDescription'];

    protected $primaryKey = 'ID_PRespel';

    public function getRouteKeyName()
	{
	    return 'PRespelSlug';
    }
    
	public function SubcategoryRespelpublic()
	{
	    return $this->belongsTo('App\Subcategoryrespelpublic', 'FK_SubCategoryRP', 'ID_SubCategoryRP');
	}
    
    public function ResiduosGener(){
		return $this->hasMany('App\ResiduosGener', 'ID_SGenerRes', 'id');
	}

    // lista los requerimientos de un residuo 1 a muchos
    public function requerimientos(){
        return $this->hasMany('App\Requerimiento', 'FK_ReqRespel', 'ID_Respel');
        //como residuos tiene muchos requerimientos
    }
}
