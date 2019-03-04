<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model{
    protected $table='holidays';
    protected $fillable = ['FestivoDate'];
    protected $primaryKey = 'ID_festivo';
}
