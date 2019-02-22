<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'Quotations';

    protected $fillable = ['CotizNum', 'CotizStatus', 'CotizSubTotal', 'FK_CotizOrden', 'FK_CotizSede'];

    protected $primarykey = 'ID_Cotiz';

}
