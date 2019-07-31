<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use App\audit;

class AuditRequest
{
    static public function auditUpdate($AuditTabla, $AuditRegistro, $Auditlog)
    {
        $log = new audit();
        $log->AuditTabla = $AuditTabla;
        $log->AuditType = "Modificado";
        $log->AuditRegistro = $AuditRegistro;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Auditlog;
        $log->save();
    }

    static public function auditDelete($AuditTabla, $AuditRegistro, $Auditlog)
    {
        $log = new audit();
        $log->AuditTabla = $AuditTabla;
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $AuditRegistro;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Auditlog;
        $log->save();
    }
}