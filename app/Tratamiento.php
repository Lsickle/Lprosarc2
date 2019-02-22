<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table = 'Tratamientos';

    protected $fillable= ['TratName', 'TratTipo', 'FK_TratProv', 'FK_TratRespel'];

    protected $primarykey = 'ID_Trat';

}
