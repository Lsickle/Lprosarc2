<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use App\audit;

class AuditRequest
{
    public static function auditUpdate($AuditTabla, $AuditRegistro, $Auditlog)
    {
        AuditRegister::audit($AuditTabla, "Modificado", $AuditRegistro, $Auditlog);
    }

    public static function auditDelete($AuditTabla, $AuditRegistro, $Auditlog)
    {
        AuditRegister::audit($AuditTabla, "Eliminado", $AuditRegistro, $Auditlog);
    }

    public static function auditRestored($AuditTabla, $AuditRegistro, $Auditlog)
    {
        AuditRegister::audit($AuditTabla, "Restaurado", $AuditRegistro, $Auditlog);
    }
}
class AuditRegister
{
    public static function audit($AuditTabla, $AuditType, $AuditRegistro, $Auditlog)
    {
        $log = new audit();
        $log->AuditTabla = $AuditTabla;
        $log->AuditType = $AuditType;
        $log->AuditRegistro = $AuditRegistro;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $Auditlog;
        $log->save();
    }

}