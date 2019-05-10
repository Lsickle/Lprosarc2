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
        ResiduosGener::destroy($id);

        $Gener = DB::table('generadors')
            ->join('gener_sedes', 'generadors.ID_Gener', '=', 'gener_sedes.FK_GSede')
            ->select('generadors.GenerSlug')
            ->where('gener_sedes.ID_GSede', '=', $RespelSedeGener->FK_SGener)
            ->first();
            
        $id = $Gener->GenerSlug;

        return redirect()->route('generadores.show', compact('id'));
    }
}
