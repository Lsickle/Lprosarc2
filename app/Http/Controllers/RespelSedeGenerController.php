<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ResiduosGener;

class RespelSedeGenerController extends Controller
{
    public function storeGener(Request $request){
        
        $Validate = $request->validate([
            'FK_SGener' => 'required|numeric',
            'FK_Respel' => 'required',
        ]);

        if($request->input('FK_Respel') !== null){
            foreach($request->FK_Respel as $Respel){ 
                $RespelSedeGener = new ResiduosGener;
                $RespelSedeGener->FK_SGener = $request->input('FK_SGener');
                $RespelSedeGener->FK_Respel = $Respel;
                $RespelSedeGener->SlugSGenerRes = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
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
        $RespelSedeGener = ResiduosGener::where('ID_SGenerRes', $id)->first();

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
            ->select('residuos_geners.ID_SGenerRes')
            ->get();

        foreach($ResiduosSGeners as $ResiduoSGener){
            ResiduosGener::destroy($ResiduoSGener->ID_SGenerRes);
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
            foreach($request->FK_Respel as $Respel){ 
                $RespelSedeGener = new ResiduosGener;
                $RespelSedeGener->FK_SGener = $SGener->ID_GSede;
                $RespelSedeGener->FK_Respel = $Respel;
                $RespelSedeGener->SlugSGenerRes = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);

                $RespelSedeGener->save();
            }
        }
        
        $id = $SGener->GSedeSlug;

        return redirect()->route('sgeneradores.show', compact('id'));
    }

    public function destroySGener($id){
        $RespelSedeGener = ResiduosGener::where('ID_SGenerRes', $id)->first();

        $SGener = DB::table('gener_sedes')
            ->select('gener_sedes.GSedeSlug')
            ->where('gener_sedes.ID_GSede', '=', $RespelSedeGener->FK_SGener)
            ->first();
        
        ResiduosGener::destroy($RespelSedeGener->ID_SGenerRes);

        $id = $SGener->GSedeSlug;

        return redirect()->route('sgeneradores.show', compact('id'));
    }
}
