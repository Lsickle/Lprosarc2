<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\AuditRequest;
use App\ResiduosGener;
use App\GenerSede;
use App\Respel;

class RespelSedeGenerController extends Controller
{
    public function __construct()
    {
        $this->tableRespelSedeGener = 'residuos_geners';
    }

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
            
        return redirect()->route('generadores.show',[$Gener->GenerSlug]);
    }

    public function destroyGener($id){
        $RespelSedeGener = ResiduosGener::select('FK_SGener', 'FK_Respel')->where('SlugSGenerRes', $id)->first();
        if (!$RespelSedeGener) {
            abort(404);
        }
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
            ->get();

        foreach($ResiduosSGeners as $ResiduoSGener){
            DB::table('residuos_geners')
            ->where('residuos_geners.ID_SGenerRes', '=', $ResiduoSGener->ID_SGenerRes)
            ->select('residuos_geners.DeleteSGenerRes')
            ->update(['DeleteSGenerRes' => 1]);

            AuditRequest::auditDelete($this->tableRespelSedeGener, $ResiduoSGener->ID_SGenerRes, 1);
        }
            
        return redirect()->route('generadores.show', [$Gener->GenerSlug]);
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
        
        return redirect()->route('sgeneradores.show', [$SGener->GSedeSlug]);
    }

    public function destroySGener($slug){
        $RespelSedeGener = ResiduosGener::where('SlugSGenerRes', $slug)->first();
        if (!$RespelSedeGener) {
            abort(404);
        }
        $SGener = DB::table('gener_sedes')->select('gener_sedes.GSedeSlug')->where('gener_sedes.ID_GSede', '=', $RespelSedeGener->FK_SGener)->first();
        
        $RespelSedeGener->DeleteSGenerRes = 1;
        $RespelSedeGener->save();

        AuditRequest::auditDelete($this->tableRespelSedeGener, $RespelSedeGener->ID_SGenerRes, 1);

        return redirect()->route('sgeneradores.show', [$SGener->GSedeSlug]);
    }
}
