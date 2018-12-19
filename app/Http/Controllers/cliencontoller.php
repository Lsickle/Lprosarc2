<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;

class clientcontoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  if ($request->hasfile('avatar')) {
        //     $file = $request->file('avatar');
        //     $name = time().$file->getClientOriginalName();
        //     $file->move(public_path().'/images/',$name);
        // }
        // else{
        //     $name = public_path().'/images/default.jpg';

        // }
        // if (empty($request->input('description'))){
        //     $desc='descripcion generada automaticamente';
        // }else{
        //     $desc=$request->input('description');
        // }
        // if (empty($request->input('slug'))){
        //     $slug=$request->input('name');
        // }else{
        //     $slug=$request->input('slug');
        // }
        $Cliente = new Cliente();
        if ($request->input('CliAuditable')=='on') {
            $Cliente->CliAuditable='1';
        };
        $Cliente->CliNit = $request->input('CliNit');
        $Cliente->CliName = $request->input('CliName');
        $Cliente->CliShortname = $request->input('CliShortname');
        $Cliente->CliCategoria = $request->input('CliCategoria');
        $Cliente->CliType = $request->input('CliType');
        $Cliente->save();
        return redirect()->route('clientes.index');
        // return 'Saved';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente = cliente::find($cliente->ID_Cli);
        $cliente->fill($request->except('created_at'));
        $cliente->save();
        return redirect()->route('clientes.index');
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
