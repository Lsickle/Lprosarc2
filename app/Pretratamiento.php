<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pretratamiento extends Model
{
    
	protected $table = 'pretratamientos';

	protected $primaryKey = 'ID_PreTrat';

	protected $fillable=['PreTratName', 'FK_Pre_Trat'];


    public function tratamiento()
	{
	 return $this->belongsTo('App\Tratamiento', 'FK_Pre_Trat', 'ID_Trat');
	}

}
