<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{

	protected $table = 'tratamientos';

	protected $primaryKey = 'ID_Trat';

	protected $fillable=['TratName', 'TratTipo', 'TratDelete', 'TratPretratamiento', 'FK_TratRespel',' FK_TratProv'];

    public function respel()
	{
	 return $this->belongsTo('App\Respel', 'FK_Tratrespel', 'ID_Respel');
	}

}
