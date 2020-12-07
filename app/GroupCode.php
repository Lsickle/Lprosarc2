<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupCode extends Model
{
    protected $table = 'group_codes';

    protected $fillable = ['VC_Empresa', 'VC_RM', 'FK_VCSolSer'];

    public $primaryKey = 'ID_GCode';

    public function codigos(){
    	return $this->haMany('App\VerificationCode', 'FK_VCGroup', 'ID_GCode');
    }


}
