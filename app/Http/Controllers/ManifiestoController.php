<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Manifiesto;
use App\Cliente;
use App\Audit;
use App\Permisos;
use App\SolicitudServicio;


class ManifiestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $manifiestos = Manifiesto::where(function($query){
            switch (Auth::user()->UsRol) {
                case 'Cliente':
                    /*se define la sede del usuario actual*/
                    $UserSedeID = DB::table('personals')
                    ->join('cargos', 'cargos.ID_Carg', 'personals.FK_PersCargo')
                    ->join('areas', 'areas.ID_Area', 'cargos.CargArea')
                    ->join('sedes', 'sedes.ID_Sede', 'areas.FK_AreaSede')
                    ->join('clientes', 'clientes.ID_Cli', 'sedes.FK_SedeCli')
                    ->where('personals.ID_Pers', Auth::user()->FK_UserPers)
                    ->value('clientes.ID_Cli');

                    $servicioscertificadosdelcliente = SolicitudServicio::where('FK_SolSerCliente',$UserSedeID)
                    ->where('SolSerStatus', 'Certificacion')
                    ->get('ID_SolSer');

                    $query->where('FK_ManifCliente', $UserSedeID);
                    $query->where('ManifSrc', '!=', 'ManifiestoDefault.pdf');
                    $query->where('ManifAuthDp','!=', 0);
                    $query->where('ManifAuthJl','!=', 0);
                    $query->where('ManifAuthJo','!=', 0);
                    $query->whereIn('FK_ManifSolser', $servicioscertificadosdelcliente);
                    break;

                case 'Comercial':
                    /*se define la sede del usuario actual*/
                    $clientes = Cliente::where('CliDelete', 0)->where('CliCategoria', 'Cliente')->where('CliComercial', Auth::user()->FK_UserPers)->get('ID_Cli');

                    // return $clientes;
                    $query->whereIn('FK_ManifCliente', $clientes);
                    break;
                
                default:
                    break;
            }
        })
        ->get();

        return view('manifiestos.index', compact('manifiestos'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manifiesto = Manifiesto::with(['SolicitudServicio' => function ($query){
            $query->with(['SolicitudResiduo' => function ($query){
                $query->where('SolResKgConciliado', '>', 0);
                $query->orWhere('SolResCantiUnidadConciliada', '>', 0);
                $query->with('generespel.respels');
                $query->with('requerimiento');
            }]);
            
        }, 'cliente.sedes.Municipios.Departamento', 'sedegenerador.generadors', 'sedegenerador.municipio.Departamento', 'gestor.sedes.Municipios.Departamento', 'tratamiento', 'transportador.sedes.Municipios.Departamento'])
        ->where('ManifSlug', $id)
        ->first();
        // return $manifiesto->transportador;
        return view('manifiestos.show', compact('manifiesto')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (in_array(Auth::user()->UsRol, Permisos::EDITMANIFCERT)||in_array(Auth::user()->UsRol2, Permisos::EDITMANIFCERT)) {
            $manifiesto = Manifiesto::where('ManifSlug', $id)->first();
            return view('manifiestos.edit', compact('manifiesto')); 
        }else{
            abort(404, "no posee permisos para la edición de manifiestos");
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
        $manifiesto = manifiesto::where('ManifSlug', $id)->first();

        $manifiesto->ManifiEspName = $request->input('ManifiEspName');
        $manifiesto->ManifiEspValue = $request->input('ManifiEspValue');
        $manifiesto->ManifObservacion = $request->input('ManifObservacion');
        $manifiesto->ManifNumRm = $request->input('ManifNumRm');
        if (isset($request['ManifSrc'])) {
            $file1 = $request['ManifSrc'];
            $hoja = $manifiesto->ManifSlug.'.pdf';

            $file1->move(public_path().'/img/Manifiestos/',$hoja);
        }
        else{
            if ($manifiesto->ManifSrc == 'ManifiestoDefault.pdf') {
                $hoja = 'ManifiestoDefault.pdf';
            }else{
                $hoja = $manifiesto->ManifSrc;
            }
        }
        $manifiesto->ManifSrc = $hoja;
        $manifiesto->save();

        return view('manifiestos.edit', compact('manifiesto')); 
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


    public function firmar($id, $servicio)
    {
         /*indice de firmas */
        // 0:Pendiente
        // 1:Director Planta
        // 2:Jefe de Logistica
        // 3:Jefe de Operaciones
        // 4:Supervisor de Turno
        // 5:Ingeniero HSEQ
        // 6:Asistente de Logistica
        // 7:Programador

         /*la variable c es para que solo firmen una vez en alguno de los campos*/
        $manifiesto = Manifiesto::where('ManifSlug', $id)->first();
        switch (Auth::user()->UsRol) {
            case 'Hseq':
                $manifiesto->ManifAuthHseq = 5;
                break;

            case 'JefeOperaciones':
                $manifiesto->ManifAuthJo = 3;
                break;

            case 'JefeLogistica':
                $manifiesto->ManifAuthJl = 2;
                break;

            case 'AdministradorPlanta':
                $manifiesto->ManifAuthDp = 1;
                break;

            case 'Supervisor':
                if (($manifiesto->ManifAuthDp == 0)&&($manifiesto->ManifAuthJl == 0)&&($manifiesto->ManifAuthJo == 0)) {
                    # code...
                }else{
                    if (($manifiesto->ManifAuthDp == 4)||($manifiesto->ManifAuthJl == 4)||($manifiesto->ManifAuthJo == 4)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($manifiesto->ManifAuthDp == 0)&&($c<1)) {
                        $manifiesto->ManifAuthDp = 4;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJl == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJl = 4;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJo == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJo = 4;
                        $c=$c+1;
                    }
                }
                
                break;

            case 'AsistenteLogistica':
                if (($manifiesto->ManifAuthDp == 0)&&($manifiesto->ManifAuthJl == 0)&&($manifiesto->ManifAuthJo == 0)) {
                    # code...
                }else{
                    if (($manifiesto->ManifAuthDp == 6)||($manifiesto->ManifAuthJl == 6)||($manifiesto->ManifAuthJo == 6)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($manifiesto->ManifAuthDp == 0)&&($c<1)) {
                        $manifiesto->ManifAuthDp = 6;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJl == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJl = 6;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJo == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJo = 6;
                        $c=$c+1;
                    }
                }
                
                break;
                   
            case 'Programador':
                if (($manifiesto->ManifAuthDp == 0)&&($manifiesto->ManifAuthJl == 0)&&($manifiesto->ManifAuthJo == 0)) {
                    # code...
                }else{
                    if (($manifiesto->ManifAuthDp == 7)||($manifiesto->ManifAuthJl == 7)||($manifiesto->ManifAuthJo == 7)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($manifiesto->ManifAuthDp == 0)&&($c<1)) {
                        $manifiesto->ManifAuthDp = 7;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJl == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJl = 7;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJo == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJo = 7;
                        $c=$c+1;
                    }
                }
                
                break;
            
            default:
                # code...
                break;
        }
        $manifiesto->save();

        $log = new audit();
        $log->AuditTabla="manifiestos";
        $log->AuditType="firmado";
        $log->AuditRegistro=$manifiesto->ID_Manif;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($id);
        $log->save();

        return redirect()->route('solicitud-servicio.documentos', [$servicio]);
    }


    public function firmarindex($id)
    {
         /*indice de firmas */
        // 0:Pendiente
        // 1:Director Planta
        // 2:Jefe de Logistica
        // 3:Jefe de Operaciones
        // 4:Supervisor de Turno
        // 5:Ingeniero HSEQ
        // 6:Asistente de Logistica
        // 7:Programador
        $manifiesto = Manifiesto::where('ManifSlug', $id)->first();
        switch (Auth::user()->UsRol) {
            case 'Hseq':
                $manifiesto->ManifAuthHseq = 5;
                break;

            case 'JefeOperaciones':
                $manifiesto->ManifAuthJo = 3;
                break;

            case 'JefeLogistica':
                $manifiesto->ManifAuthJl = 2;
                break;

            case 'AdministradorPlanta':
                $manifiesto->ManifAuthDp = 1;
                break;

            case 'Supervisor':
                if (($manifiesto->ManifAuthDp == 0)&&($manifiesto->ManifAuthJl == 0)&&($manifiesto->ManifAuthJo == 0)) {
                    # code...
                }else{
                    if (($manifiesto->ManifAuthDp == 4)||($manifiesto->ManifAuthJl == 4)||($manifiesto->ManifAuthJo == 4)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($manifiesto->ManifAuthDp == 0)&&($c<1)) {
                        $manifiesto->ManifAuthDp = 4;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJl == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJl = 4;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJo == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJo = 4;
                        $c=$c+1;
                    }
                }
                
                break;

            case 'AsistenteLogistica':
                if (($manifiesto->ManifAuthDp == 0)&&($manifiesto->ManifAuthJl == 0)&&($manifiesto->ManifAuthJo == 0)) {
                    # code...
                }else{
                    if (($manifiesto->ManifAuthDp == 6)||($manifiesto->ManifAuthJl == 6)||($manifiesto->ManifAuthJo == 6)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($manifiesto->ManifAuthDp == 0)&&($c<1)) {
                        $manifiesto->ManifAuthDp = 6;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJl == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJl = 6;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJo == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJo = 6;
                        $c=$c+1;
                    }
                }
                
                break;
                   
            case 'Programador':
                if (($manifiesto->ManifAuthDp == 0)&&($manifiesto->ManifAuthJl == 0)&&($manifiesto->ManifAuthJo == 0)) {
                    # code...
                }else{
                    if (($manifiesto->ManifAuthDp == 7)||($manifiesto->ManifAuthJl == 7)||($manifiesto->ManifAuthJo == 7)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($manifiesto->ManifAuthDp == 0)&&($c<1)) {
                        $manifiesto->ManifAuthDp = 7;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJl == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJl = 7;
                        $c=$c+1;
                    }
                    if (($manifiesto->ManifAuthJo == 0)&&($c<1)) {
                        $manifiesto->ManifAuthJo = 7;
                        $c=$c+1;
                    }
                }
                
                break;
            
            default:
                # code...
                break;
        }
        $manifiesto->save();

        $log = new audit();
        $log->AuditTabla="manifiestos";
        $log->AuditType="firmado";
        $log->AuditRegistro=$manifiesto->ID_Manif;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($id);
        $log->save();

        return redirect()->route('manifiestos.index');
    }
}
