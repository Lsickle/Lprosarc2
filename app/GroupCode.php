<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupCode extends Model
{
    protected $table = 'group_codes';

    protected $fillable = ['GC_Empresa'];

    public $primaryKey = 'ID_GCode';

    public function codigos(){
    	return $this->hasMany('App\VerificationCode', 'FK_VCGroup', 'ID_GCode');
    }


}
