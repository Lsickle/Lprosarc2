<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use App\Http\Requests\RespelStoreRequest;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RespelMail;
use App\audit;
use App\Respel;
use App\Sede;
use App\Cotizacion;
use App\Tratamiento;
use App\Pretratamiento;
use App\Clasificacion;
use App\User;
use App\Requerimiento;
use App\Rango;
use App\ResiduosGener;
use App\Permisos;
use App\Tarifa;
use App\Categoryrespelpublic;
use App\Subcategoryrespelpublic;
use App\Respelpublic;
use Illuminate\Support\Arr;

class RespelPublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (in_array(Auth::user()->UsRol, Permisos::TODOPROSARC)) {
         /*se accede a la lista de residuos comunes unicamente para prosarc*/
        $PublicRespels = Respelpublic::with('SubcategoryRespelpublic.CategoryRP')->get();
        // return $PublicRespels[0]->SubcategoryRespelpublic->CategoryRP->CategoryRpName;
        return view('publicrespel.index', compact('PublicRespels')); 
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(in_array(Auth::user()->UsRol, Permisos::CLIENTE)){
            $Sede = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->select('sedes.ID_Sede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->get();
            return view('respels.create', compact('Sede'));
        }elseif(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC) || in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC)){

            $categories = Categoryrespelpublic::all();

            $Sedes = DB::table('clientes')
                ->join('sedes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                ->select('sedes.ID_Sede', 'clientes.CliName')
                ->where('clientes.ID_Cli', '<>', 1) 
                ->get();
            return view('publicrespel.create', compact('Sedes', 'categories'));
        }else{
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RespelStoreRequest $request)
    {
         if (in_array(Auth::user()->UsRol, Permisos::CLIENTE)) {
            $UserSedeID = DB::table('personals')
                ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                ->value('sedes.ID_Sede');
        }else{
            $UserSedeID = $request->input('Sede');
        }
        // return $request;
        

        for ($x=0; $x < count($request['RespelName']); $x++) {
            /*validar si el formulario incluye archivos de tarjeta de emergencia u hoja de seguridad*/

            $prespel = new Respelpublic();

            if (isset($request['RespelHojaSeguridad'][$x])) {
                $file1 = $request['RespelHojaSeguridad'][$x];
                $hoja = hash('sha256', rand().time().$file1->getClientOriginalName()).'.pdf';

                $file1->move(public_path().'/img/HojaSeguridad/',$hoja);
            }
            else{
                $hoja = 'RespelHojaDefault.pdf';
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelTarj'][$x])) {
                $file2 = $request['RespelTarj'][$x];
                $tarj = hash('sha256', rand().time().$file2->getClientOriginalName()).'.pdf';
                $file2->move(public_path().'/img/TarjetaEmergencia/',$tarj);
            }else{
                $tarj = 'RespelTarjetaDefault.pdf';
            }

             /*verificar si se cargo un documento en este campo*/
            if (isset($request['RespelFoto'][$x])) {
                $file3 = $request['RespelFoto'][$x];
                $foto = hash('sha256', rand().time().$file3->getClientOriginalName()).'.png';
                $file3->move(public_path().'/img/fotoRespelCreate/',$foto);
            }else{
                $foto = 'RespelFotoDefault.png';
            }
    
            /*verificar si se cargo un documento en este campo*/
            if (isset($request['SustanciaControladaDocumento'][$x])) {
                $file4 = $request['SustanciaControladaDocumento'][$x];
                $ctrlDoc = hash('sha256', rand().time().$file4->getClientOriginalName()).'.pdf';
                $file4->move(public_path().'/img/SustanciaControlDoc/',$ctrlDoc);
            }else{
                $ctrlDoc = 'SustanciaControlDocDefault.pdf';
            }

            $prespel->PRespelName = $request['RespelName'][$x];
            $prespel->PRespelDescrip = $request['RespelDescrip'][$x];
            $prespel->PRespelIgrosidad = $request['RespelIgrosidad'][$x];
            $prespel->PYRespelClasf4741 = $request['YRespelClasf4741'][$x];
            $prespel->PARespelClasf4741 = $request['ARespelClasf4741'][$x];
            $prespel->PRespelEstado = $request['RespelEstado'][$x];

            // se verifica si la sustancia esta marcada como controlada
            if (isset($request['SustanciaControlada'][$x])&&($request['SustanciaControlada'][$x]==1)) {
                $prespel->PSustanciaControlada = $request['SustanciaControlada'][$x];
                $prespel->PSustanciaControladaTipo = $request['SustanciaControladaTipo'][$x];
                $prespel->PSustanciaControladaNombre = $request['SustanciaControladaNombre'][$x];
                $prespel->PSustanciaControladaDocumento = $ctrlDoc;
            }else{
                $prespel->PSustanciaControlada = 0;
            }
            $prespel->PRespelStatus = "Pendiente";
            // $prespel->PRespelStatus = $statusinicial;
            $prespel->PRespelHojaSeguridad = $hoja;
            $prespel->PRespelTarj = $tarj;
            $prespel->PRespelFoto = $foto;
            $prespel->FK_SubCategoryRP = $request['FK_SubCategoryRP'];
            $prespel->PRespelSlug = hash('sha256', rand().time().$prespel->PRespelName);
            $prespel->PRespelDelete = 0;
            $prespel->PRespelDeclaracion = $request['RespelDeclaracion'][$x];
            $prespel->save();
        }
        return redirect()->route('respelspublic.index');
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
        /*se verifican el rol del usuario para dar acceso a la edicion de respel o evaluacion de respel*/
        if(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC) || in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC)){

            $Respels = Respelpublic::where('PRespelSlug', $id)->first();
            // return $Respels;
            /*se valida que el residuo no este eliminado*/
            if ($Respels->PRespelDelete == 1) {
                abort(404);
            }
            
            $categories = Categoryrespelpublic::all();

            $Subcategory = Subcategoryrespelpublic::where('ID_SubCategoryRP', $Respels->FK_SubCategoryRP)->first();
            // return $Subcategory;
            return view('publicrespel.edit', compact('Respels', 'categories', 'Subcategory'));
        }else{
            abort(403);
        }
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
