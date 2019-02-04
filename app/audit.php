<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class audit extends Model
{
    protected $table = 'audits';

    protected $fillable = ['AuditTabla', 'AuditRegistro', 'AuditUser', 'Auditlog'];

}
