<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ArticuloPorProveedor;
use App\Activo;
use App\Quotation;
use App\audit;

class ArticuloXProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ArtProvs = DB::table('articulo_por_proveedors')
            ->join('activos', 'activos.ID_Act', '=', 'articulo_por_proveedors.FK_ArtiActiv')
            ->select('articulo_por_proveedors.*', 'activos.ActName')
            ->get();

        return view('articulos.index', compact('ArtProvs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Activos = Activo::all();
        $Quotations = Quotation::all();

        return view('articulos.create', compact('Activos', 'Quotations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ArtProv = new ArticuloPorProveedor();
        $ArtProv->ArtiUnidad = $request->input("ArtiUnidad");
        $ArtProv->ArtiCant = $request->input("ArtiCant");
        $ArtProv->ArtiPrecio = $request->input("ArtiPrecio");
        $ArtProv->ArtiCostoUnid = $request->input("ArtiCostoUnid");
        $ArtProv->ArtiMinimo = $request->input("ArtiMinimo");

        $ArtProv->FK_ArtCotiz = $request->input("FK_ArtCotiz");
        $ArtProv->FK_ArtiActiv = $request->input("FK_ArtiActiv");
        // $ArtProv->FK_AutorizedBy = $request->input("FK_AutorizedBy");
        $ArtProv->FK_AutorizedBy = 1;
        $ArtProv->save();

        return redirect()->route('articulos-proveedor.index');
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
        $ArtProvs = ArticuloPorProveedor::where('ID_ArtiProve', $id)->first();

        $Activos = Activo::all();

        $Quotations = Quotation::all();

        return view('articulos.edit', compact('ArtProvs', 'Quotations', 'Activos'));  
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
        $ArtProvs = ArticuloPorProveedor::where('ID_ArtiProve', $id)->first();
        $ArtProvs->fill($request->all());
        $ArtProvs->save();

        $log = new audit();
        $log->AuditTabla = "articulo_por_proveedors";
        $log->AuditType = "Modificado";
        $log->AuditRegistro = $ArtProvs->ID_ArtiProve;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $request->all();
        $log->save();

        return redirect()->route('articulos-proveedor.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ArtProvs = ArticuloPorProveedor::where('ID_ArtiProve', $id)->first();

        if ($ArtProvs->ArtDelete == 0){
            $ArtProvs->ArtDelete = 1;
        }
        else{
            $ArtProvs->ArtDelete = 0;
        }
        $ArtProvs->save();

        $log = new audit();
        $log->AuditTabla = "articulo_por_proveedors";
        $log->AuditType = "Eliminado";
        $log->AuditRegistro = $ArtProvs->ID_ArtiProve;
        $log->AuditUser = Auth::user()->email;
        $log->Auditlog = $ArtProvs->ArtDelete;
        $log->save();

        return redirect()->route('articulos-proveedor.index');
    }
}
