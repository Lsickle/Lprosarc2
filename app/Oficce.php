<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficce extends Model{
    protected $table='Oficces';
    protected $fillable=['OfiAddress','OfiModule','OfiArea'];
    protected $primaryKey= 'ID_Ofi';

    public function areas(){
    	return $this>belongsTo('OfiArea','ID_Area');
    }
}
