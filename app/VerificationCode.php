<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $table = 'verification_codes';

    protected $fillable = ['VC_Empresa', 'VC_RM', 'FK_VCSolSer'];

    public $primaryKey = 'ID_VCode';

    public function servicio(){
    	return $this->belongsTo('App\SolicitudServicio', 'FK_VCSolSer', 'ID_SolSer');
    }
    protected $casts = [
        'VC_RM' => 'array',
    ];

}
