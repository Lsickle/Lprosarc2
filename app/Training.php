<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model{
    protected $table='trainings';
    protected $fillable = ['CapaName','CapaTipo','CapaDate','CapaExpire','FK_CapaTeacher','FK_CapaPers'];
    protected $primaryKey = 'ID_Capa';
}
