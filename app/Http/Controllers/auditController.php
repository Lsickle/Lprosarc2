<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\audit;
use Carbon\Carbon;

class auditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $auditorias = audit::where('created_at', '>', Carbon::now()->subMonths(1))->orderBy('id', 'desc')->get();
        $auditorias = audit::where('created_at', '>', Carbon::now()->subMonths(1))
        // ->where('id', '>', 36818)
        ->orderBy('id', 'desc')->get();
        foreach ($auditorias as $key => $value) {
            # code...
        
            if (is_array($value->Auditlog)) {
                $value->tipo = 'array';
            }else{
                $result = json_decode($value->Auditlog, true, 4);
                $value->Auditlog = $result;
                if (is_array($result)) {
                    $value->tipo = 'json';
                }else{
                    $value->tipo = 'string';
                }
            }
        }
        // return $auditorias;
        return view('audits.index', compact('auditorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
