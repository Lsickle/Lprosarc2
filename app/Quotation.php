<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'Quotations';

    protected $fillable = ['CotizNum', 'CotizStatus', 'CotizSubTotal'];

    protected $primarykey = 'ID_Cotiz';

}
