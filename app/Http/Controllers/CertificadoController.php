<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Certificado;
use App\Cliente;
use App\Generador;
use App\Tratamiento;
use App\Audit;
use App\Certdato;
use App\Permisos;
use App\SolicitudServicio;


class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            
        $certificados = Certificado::where(function($query){
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
                    ->where('SolServCertStatus', 2)
                    ->get('ID_SolSer');

                    // return $UserSedeID;
                    $query->where('FK_CertCliente', $UserSedeID);
                    $query->where('CertSrc', '!=', 'CertificadoDefault.pdf');
                    $query->where('CertAuthJo', '!=', 0);
                    $query->where('CertAuthJl', '!=', 0);
                    $query->where('CertAuthDp', '!=', 0);
                    $query->whereIn('FK_CertSolser', $servicioscertificadosdelcliente);
                    break;

                case 'Comercial':
                    /*se define la sede del usuario actual*/
                    $clientes = Cliente::where('CliDelete', 0)->where('CliCategoria', 'Cliente')->where('CliComercial', Auth::user()->FK_UserPers)->get('ID_Cli');

                    // return $clientes;
                    $query->whereIn('FK_CertCliente', $clientes);
                    break;
                
                default:
                    // $query->where('ID_Cert', '>', 0);
                    break;
            }
        })
        ->get();
        
        return view('certificados.index', compact('certificados')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // $SolicitudServicio = SolicitudServicio::where('SolSerSlug', $id)->first();
        // if (!$SolicitudServicio) {
        //     abort(404);
        // }
        // $certificado = new Certificado;
        // $certificado->CertNumero = '';
        // $certificado->CertiEspName = '';
        // $certificado->CertiEspValue = '';
        // $certificado->CertObservacion = '';
        // $certificado->CertSrc = '';
        // $certificado->CertAuthJo = '';
        // $certificado->CertAuthJl = '';
        // $certificado->CertAuthDp = '';
        // $certificado->CertAnexo = '';
        // $certificado->FK_CertSolser = $SolicitudServicio->ID_SolSer;
        // $certificado->save();

        // $certificado->CertNumero = $certificado->ID_SolSer;
        // $certificado->update();


        // return view('certificados.edit', compact('SolicitudServicio')); 

        // return redirect()->route('solicitud-servicio.solservdocindex', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $SolicitudServicio = SolicitudServicio::where('SolSerSlug', $id)->first();
        if (!$SolicitudServicio) {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certificado = Certificado::with(['SolicitudServicio' => function ($query){
            $query->with(['SolicitudResiduo' => function ($query){
                $query->where('SolResKgConciliado', '>', 0);
                $query->orWhere('SolResCantiUnidadConciliada', '>', 0);
                $query->with('generespel.respels');
                $query->with('requerimiento');
            }]);
            
        }, 'cliente.sedes.Municipios.Departamento', 'sedegenerador.generadors', 'sedegenerador.municipio.Departamento', 'gestor.sedes.Municipios.Departamento', 'tratamiento', 'transportador.sedes.Municipios.Departamento'])
        ->where('CertSlug', $id)
        ->first();
        // return $certificado;
        return view('certificados.show', compact('certificado')); 
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
            $certificado = Certificado::where('CertSlug', $id)->first();
            return view('certificados.edit', compact('certificado')); 
        }else{
            abort(404, "no posee permisos para la edición de certificados");
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
        $certificado = Certificado::where('CertSlug', $id)->first();

        $certificado->CertiEspName = $request->input('CertiEspName');
        $certificado->CertiEspValue = $request->input('CertiEspValue');
        $certificado->CertObservacion = $request->input('CertObservacion');
        $certificado->CertNumRm = $request->input('CertNumRm');
        if (isset($request['CertSrc'])) {
            $file1 = $request['CertSrc'];
            $hoja = $certificado->CertSlug.'.pdf';

            $file1->move(public_path().'/img/Certificados/',$hoja);
        }
        else{
            if ($certificado->CertSrc == 'CertificadoDefault.pdf') {
                $hoja = 'CertificadoDefault.pdf';
            }else{
                $hoja = $certificado->CertSrc;
            }
        }
        $certificado->CertSrc = $hoja;
        $certificado->save();

        return view('certificados.edit', compact('certificado')); 
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
        $certificado = Certificado::where('CertSlug', $id)->first();
        switch (Auth::user()->UsRol) {
            case 'Hseq':
                $certificado->CertAuthHseq = 5;
                break;

            case 'JefeOperaciones':
                $certificado->CertAuthJo = 3;                
                break;

            case 'JefeLogistica':
                $certificado->CertAuthJl = 2;
                break;

            case 'AdministradorPlanta':
                $certificado->CertAuthDp = 1;
                break;

            case 'Supervisor':
                if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
                    # code...
                }else{
                    if (($certificado->CertAuthDp == 4)||($certificado->CertAuthJl == 4)||($certificado->CertAuthJo == 4)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($certificado->CertAuthDp == 0)&&($c<1)) {
                        $certificado->CertAuthDp = 4;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJl == 0)&&($c<1)) {
                        $certificado->CertAuthJl = 4;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJo == 0)&&($c<1)) {
                        $certificado->CertAuthJo = 4;
                        $c=$c+1;
                    }
                }
                
                break;

            case 'AsistenteLogistica':
                if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
                    # code...
                }else{
                    if (($certificado->CertAuthDp == 6)||($certificado->CertAuthJl == 6)||($certificado->CertAuthJo == 6)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($certificado->CertAuthDp == 0)&&($c<1)) {
                        $certificado->CertAuthDp = 6;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJl == 0)&&($c<1)) {
                        $certificado->CertAuthJl = 6;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJo == 0)&&($c<1)) {
                        $certificado->CertAuthJo = 6;
                        $c=$c+1;
                    }
                }
                
                break;

                   
            case 'Programador':
                if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
                    # code...
                }else{
                    if (($certificado->CertAuthDp == 7)||($certificado->CertAuthJl == 7)||($certificado->CertAuthJo == 7)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($certificado->CertAuthDp == 0)&&($c<1)) {
                        $certificado->CertAuthDp = 7;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJl == 0)&&($c<1)) {
                        $certificado->CertAuthJl = 7;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJo == 0)&&($c<1)) {
                        $certificado->CertAuthJo = 7;
                        $c=$c+1;
                    }
                }
                
                break;
            
            default:
                # code...
                break;
        }
        $certificado->save();

        $log = new audit();
        $log->AuditTabla="certificado";
        $log->AuditType="firmado";
        $log->AuditRegistro=$certificado->ID_Cert;
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
        $certificado = Certificado::where('CertSlug', $id)->first();
        switch (Auth::user()->UsRol) {
            case 'Hseq':
                $certificado->CertAuthHseq = 5;
                break;

            case 'JefeOperaciones':
                $certificado->CertAuthJo = 3;
                break;

            case 'JefeLogistica':
                $certificado->CertAuthJl = 2;
                break;

            case 'AdministradorPlanta':
                $certificado->CertAuthDp = 1;
                break;

            case 'Supervisor':
                if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
                    # code...
                }else{
                    if (($certificado->CertAuthDp == 4)||($certificado->CertAuthJl == 4)||($certificado->CertAuthJo == 4)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($certificado->CertAuthDp == 0)&&($c<1)) {
                        $certificado->CertAuthDp = 4;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJl == 0)&&($c<1)) {
                        $certificado->CertAuthJl = 4;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJo == 0)&&($c<1)) {
                        $certificado->CertAuthJo = 4;
                        $c=$c+1;
                    }
                }
                
                break;

            case 'AsistenteLogistica':
                if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
                    # code...
                }else{
                    if (($certificado->CertAuthDp == 6)||($certificado->CertAuthJl == 6)||($certificado->CertAuthJo == 6)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($certificado->CertAuthDp == 0)&&($c<1)) {
                        $certificado->CertAuthDp = 6;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJl == 0)&&($c<1)) {
                        $certificado->CertAuthJl = 6;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJo == 0)&&($c<1)) {
                        $certificado->CertAuthJo = 6;
                        $c=$c+1;
                    }
                }
                
                break;

                   
            case 'Programador':
                if (($certificado->CertAuthDp == 0)&&($certificado->CertAuthJl == 0)&&($certificado->CertAuthJo == 0)) {
                    # code...
                }else{
                    if (($certificado->CertAuthDp == 7)||($certificado->CertAuthJl == 7)||($certificado->CertAuthJo == 7)) {
                        $c=1;
                    }else{
                        $c=0;
                    }
                    if (($certificado->CertAuthDp == 0)&&($c<1)) {
                        $certificado->CertAuthDp = 7;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJl == 0)&&($c<1)) {
                        $certificado->CertAuthJl = 7;
                        $c=$c+1;
                    }
                    if (($certificado->CertAuthJo == 0)&&($c<1)) {
                        $certificado->CertAuthJo = 7;
                        $c=$c+1;
                    }
                }
                
                break;
            
            default:
                # code...
                break;
        }
        $certificado->save();

        $log = new Audit();
        $log->AuditTabla="certificado";
        $log->AuditType="firmado";
        $log->AuditRegistro=$certificado->ID_Cert;
        $log->AuditUser=Auth::user()->email;
        $log->Auditlog=json_encode($id);
        $log->save();

        return redirect()->route('certificados.index');
    }



}
