<?php

namespace App\Http\Controllers;

use App\GroupCode;
use App\VerificationCode;
use App\SolicitudServicio;
use Illuminate\Http\Request;

class GroupCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupCodes = GroupCode::with('codigos')->orderBy('created_at','desc')->get();

		return view('groupcodes.index', compact('groupCodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groupcodes.create', compact('groupCodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validate = $request->validate([
			'FK_VCSolSer' => 'exists:solicitud_servicios,ID_SolSer'
        ],
        [
            'FK_VCSolSer.exists' => 'El Número de Servicio :input no existe...',
        ]);

        $groupcode = new GroupCode();
        $groupcode->GC_Empresa = $request->input('GC_Empresa');
        $groupcode->save();


        $words = explode(" ", $request->input('GC_Empresa'));
        $acronym = "";

        foreach ($words as $w) {
        $acronym .= $w[0];
        }

        for ($i=0; $i < $request->input('VC_cantidad'); $i++) { 
            $verCode = new VerificationCode();
            $verCode->VC_RM = $request->input('VC_RM');
            $verCode->VC_Empresa = $request->input('GC_Empresa');
            $verCode->VCode = $groupcode->ID_GCode.$acronym.hash('sha256', rand().time().$groupcode->ID_GCode);
            $verCode->FK_VCSolSer = $request->input('FK_VCSolSer');
            $verCode->FK_VCGroup = $groupcode->ID_GCode;
            $verCode->save();
        }

        return redirect()->route('groupcodes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupCode  $groupCode
     * @return \Illuminate\Http\Response
     */
    public function show(GroupCode $groupCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupCode  $groupCode
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupCode $groupCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupCode  $groupCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupCode $groupCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupCode  $groupCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupCode $groupCode)
    {
        //
    }
}
