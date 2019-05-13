<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ResiduosGener;

class RespelSedeGenerController extends Controller
{
    public function store(Request $request){
        
        $Validate = $request->validate([
            'FK_SGener' => 'required|numeric',
            'FK_Respel' => 'required',
        ]);

        if($request->input('FK_Respel') !== null){
            foreach($request->FK_Respel as $file){ 
                $RespelSedeGener = new ResiduosGener;
                $RespelSedeGener->FK_SGener = $request->input('FK_SGener');
                $RespelSedeGener->FK_Respel = $file;
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

    public function destroy($id){
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
}
