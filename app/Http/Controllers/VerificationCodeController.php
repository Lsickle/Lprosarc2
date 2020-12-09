<?php

namespace App\Http\Controllers;

use App\VerificationCode;
use App\GroupCode;
use Illuminate\Http\Request;

class VerificationCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = VerificationCode::with('grupo')->orderBy('created_at','desc')->get();

		return view('verifycodes.index', compact('codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function show(VerificationCode $verificationCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $verificationCode = VerificationCode::with('grupo')->where('ID_VCode', $id)->first();

		return view('verifycodes.edit', compact('verificationCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $verificationCode = VerificationCode::with('grupo')->where('ID_VCode', $id)->first();
        $verificationCode->VC_Empresa = $request->input('VC_Empresa');
        $verificationCode->FK_VCSolSer = $request->input('FK_VCSolSer');
        $verificationCode->custom = $request->input('custom');
        $verificationCode->VC_RM = $request->input('VC_RM');
        $verificationCode->save();

        return redirect()->route('verifycodes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificationCode $verificationCode)
    {
        //
    }
}
