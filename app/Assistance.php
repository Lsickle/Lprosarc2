<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistance extends Model{

    protected $table = 'assistances';

    protected $fillable = ['AsisLlegada','AsisSalida','AsisNocturnas'];

    protected $primaryKey = 'ID_Asis';

    public function personals()
    {
    	return $this->belongsTo('App\Personal','ID_Pers');
    }

}
