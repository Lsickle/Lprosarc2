<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model{
    protected $table='personals';
    protected $fillable = ['PersType','PersDocType','PersDocNumber','PersFirstName','PersSecondName','PersLastName','PersEmail','PersLibreta','PersPase','PersBirthday','PersPhoneNumber','PersCellphone','PersAddress','PersEPS','PersARL','PersBank','PersBankAccaunt','PersIngreso','PersSalida','FK_PersCargo'];
    protected $primaryKey = 'ID_Pers';

    public function cargos(){
    	return $this>belongsTo('FK_PersCargo','ID_Carg');
    }
}
