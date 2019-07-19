<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\ResiduosGener;
use App\GenerSede;
use App\Respel;
use App\audit;

class RespelSedeGenerController extends Controller
{
    public function storeGener(Request $request){
        
        $Validate = $request->validate([
            'FK_SGener' => 'required',
            'FK_Respel' => 'required',
        ]);

        if($request->input('FK_Respel') !== null){
            $SGener = GenerSede::select('ID_GSede')->where('GSedeSlug', $request->input('FK_SGener'))->first();
            foreach($request->FK_Respel as $Respel1){ 
                $Respel2 = Respel::select('ID_Respel')->where('RespelSlug', $Respel1)->first();
                $RespelSedeGener = new ResiduosGener;
                $RespelSedeGener->FK_SGener = $SGener->ID_GSede;
                $RespelSedeGener->FK_Respel = $Respel2->ID_Respel;
                $RespelSedeGener->SlugSGenerRes = hash('sha256', rand().time().$RespelSedeGener->FK_SGener);
                $RespelSedeGener->DeleteSGenerRes = 0;
                $RespelSedeGener->save();
            }
        }
        
        $Gener = DB::table('generadors')
            ->join('gener_sedes', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->select('generadors.GenerSlug')
            ->where('gener_sedes.ID_GSede', '=', $RespelSedeGener->FK_SGener)
            ->first();
            
        $id = $Gener->GenerSlug;

        return redirect()->route('generadores.show', compact('id'));
    }

    public function destroyGener($id){
        $RespelSedeGener = ResiduosGener::select('FK_SGener', 'FK_Respel')->where('SlugSGenerRes', $id)->first();
        
        $Gener = DB::table('generadors')
            ->join('gener_sedes', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->select('generadors.GenerSlug', 'generadors.ID_Gener')
            ->where('gener_sedes.ID_GSede', '=', $RespelSedeGener->FK_SGener)
            ->first();

        $ResiduosSGeners = DB::table('residuos_geners')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
            ->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->where('residuos_geners.FK_Respel', '=', $RespelSedeGener->FK_Respel)
            ->where('gener_sedes.FK_GSede', '=', $Gener->ID_Gener)
            ->select('residuos_geners.ID_SGenerRes', 'residuos_geners.DeleteSGenerRes')
            ->update(['DeleteSGenerRes' => 1]);

        $ResiduosSGeners = DB::table('residuos_geners')
            ->join('gener_sedes', 'gener_sedes.ID_GSede', '=', 'residuos_geners.FK_SGener')
            ->join('respels', 'respels.ID_Respel', '=', 'residuos_geners.FK_Respel')
            ->where('residuos_geners.FK_Respel', '=', $RespelSedeGener->FK_Respel)
            ->where('gener_sedes.FK_GSede', '=', $Gener->ID_Gener)
            ->select('residuos_geners.ID_SGenerRes', 'residuos_geners.DeleteSGenerRes')
            ->get();

        foreach($ResiduosSGeners as $ResiduoSGener){
            $log = new audit();
            $log->AuditTabla="residuos_geners";
            $log->AuditType="Eliminado";
            $log->AuditRegistro=$ResiduoSGener->ID_SGenerRes;
            $log->AuditUser=Auth::user()->email;
            $log->Auditlog = $ResiduoSGener->DeleteSGenerRes;
            $log->save();
        }
            
        $id = $Gener->GenerSlug;

        return redirect()->route('generadores.show', compact('id'));
    }

    public function storeSGener(Request $request){
        
        $Validate = $request->validate([
            'FK_SGener' => 'required',
            'FK_Respel' => 'required',
        ]);

        $SGener = DB::table('gener_sedes')
            ->select('gener_sedes.GSedeSlug', 'gener_sedes.ID_GSede')
            ->where('gener_sedes.GSedeSlug', '=', $request->input('FK_SGener'))
            ->first();
            
        if($request->input('FK_Respel') !== null){
            foreach($request->FK_Respel as $Respel1){ 
                $Respel2 = Respel::select('ID_Respel')->where('RespelSlug', $Respel1)->first();
                $RespelSedeGener = new ResiduosGener;
                $RespelSedeGener->FK_SGener = $SGener->ID_GSede;
                $RespelSedeGener->FK_Respel = $Respel2->ID_Respel;
                $RespelSedeGener->DeleteSGenerRes = 0;
                $RespelSedeGener->SlugSGenerRes = hash('sha256', rand().time().$RespelSedeGener->FK_Respel);
                $RespelSedeGener->save();
            }
        }
        
        $id = $SGener->GSedeSlug;

        return redirect()->route('sgeneradores.show', compact('id'));
    }

    public function destroySGener($id){
        $RespelSedeGener = ResiduosGener::where('SlugSGenerRes', $id)->first();

        $SGener = DB::table('gener_sedes')
            ->select('gener_sedes.GSedeSlug')
            ->where('gener_sedes.ID_GSede', '=', $RespelSedeGener->FK_SGener)
            ->first();
        
        $RespelSedeGener->DeleteSGenerRes = 1;
        $RespelSedeGener->save();

        $id = $SGener->GSedeSlug;

        return redirect()->route('sgeneradores.show', compact('id'));
    }
}
