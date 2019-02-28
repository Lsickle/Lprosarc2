<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $table = 'qr_codes';
    
    protected $fillable = ['QrCodeEstiba', 'QrCodeSrc'];

    protected $primaryKey = 'ID_QrCode';

    public function SolicitudServicio()
    {
    	return $this->belogsTo('App\SolicitudServicio','ID_SolSer', 'id');
    }
}
