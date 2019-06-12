<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\userController;

class SolServStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'FK_SolSerPersona'  => ['required',Rule::exists('personals', 'PersSlug')->where(function ($query) use ($request){
                $Personal = DB::table('personals')
                    ->join('cargos', 'personals.FK_PersCargo', '=', 'cargos.ID_Carg')
                    ->join('areas', 'cargos.CargArea', '=', 'areas.ID_Area')
                    ->join('sedes', 'areas.FK_AreaSede', '=', 'sedes.ID_Sede')
                    ->join('clientes', 'sedes.FK_SedeCli', '=', 'clientes.ID_Cli')
                    ->select('cargos.ID_Carg')
                    ->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
                    ->where('personals.PersSlug', $request->input('FK_SolSerPersona'))
                    ->first();
                if(isset($Personal->ID_Carg)){
                    $query->where('personals.FK_PersCargo', $Personal->ID_Carg);
                }
                else{
                    $query->where('personals.FK_PersCargo', null);
                }
            })],
            'SolSerTipo'        => 'required|numeric|between:98,99',
            'SolResAuditoriaTipo' => 'required|numeric|between:97,99',
        ];
        if($request->input('SolSerDevolucion') == 'on'){
            $rules = [
                'SolSerDevolucionTipo'  => 'required',
            ];
        }
        if($request->input('SolSerTipo') == 98){
            $rules = [
                'SolSerTransportador' => 'required|numeric|between:98,99',
                'SolSerConductor'     => 'required|max:255',
                'SolSerVehiculo'      => 'required|max:9',
            ];
            if($request->input('SolSerTransportador') == 98){
                $rules = [
                    'SolSerNameTrans'    => 'required|max:255',
                    'SolSerNitTrans'     => 'required|max:20',
                    'SolSerAdressTrans'  => 'required|max:255',
                    'SolSerCityTrans'    => ['required',Rule::exists('municipios', 'ID_Mun')],
                    'SolSerConductor'     => 'required|max:255',
                    'SolSerVehiculo'      => 'required|max:9',
                ];
            }
        }
        else{
            $rules = [
                'SolSerTypeCollect'     => 'required|numeric|between:97,99',
            ];
            if($request->input('SolSerTypeCollect') <> 99){
                if($request->input('SolSerTypeCollect') == 98){
                    $rules = [
                        'SedeCollect'     => 'required',
                    ];
                }
                if($request->input('SolSerTypeCollect') == 97){
                    $rule = [
                        'AddressCollect'           => 'required|max:255',
                    ];
                }
            }
        }
        foreach ($request->input('SGenerador') as $Generador => $value) {
            $rules['SGenerador.'.$Generador] = ['required', Rule::exists('gener_sedes', 'GSedeSlug')->where(function ($query) use ($request ,$Generador){
                $SGeneradors = DB::table('gener_sedes')
                    ->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
                    ->select('generadors.ID_Gener')
                    ->where('gener_sedes.GSedeSlug', $request['SGenerador'][$Generador])
                    ->first();
                if(isset($SGeneradors->ID_Gener)){
                    $query->where('gener_sedes.FK_GSede', $SGeneradors->ID_Gener);
                }
                else{
                    $query->where('gener_sedes.FK_GSede', null);
                }
            })];
            $rules['FK_SolResRg.'.$Generador.'.0'] = 'required';
            if(isset($request['FK_SolResRg'][$Generador][0])){
                for ($y=0; $y < count($request['FK_SolResRg'][$Generador]); $y++) {
                    $rules['FK_SolResRg.'.$Generador.'.'.$y] = ['required',Rule::exists('residuos_geners', 'SlugSGenerRes')->where(function ($query) use ($request ,$Generador, $y){
                        $RespelGeneradors = DB::table('residuos_geners')
                            ->join('gener_sedes', 'residuos_geners.FK_SGener', '=', 'gener_sedes.ID_GSede')
                            ->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
                            ->select('gener_sedes.ID_GSede')
                            ->where('residuos_geners.SlugSGenerRes', $request['FK_SolResRg'][$Generador][$y])
                            ->first();
                        if(isset($RespelGeneradors->ID_GSede)){
                            $query->where('residuos_geners.FK_SGener', $RespelGeneradors->ID_GSede);
                        }
                        else{
                            $query->where('residuos_geners.FK_SGener', null);
                        }
                    })];
                    $rules['SolResTypeUnidad.'.$Generador.'.'.$y] = 'nullable|numeric|between:98,99';
                    $rules['SolResCantiUnidad.'.$Generador.'.'.$y] = 'nullable|numeric';
                    $rules['SolResKgEnviado.'.$Generador.'.'.$y] = 'required|numeric';
                    $rules['SolResEmbalaje.'.$Generador.'.'.$y] = 'required|numeric|between:88,99';
                    $rules['SolResAlto.'.$Generador.'.'.$y] = 'nullable|numeric|max:20|min:0';
                    $rules['SolResAncho.'.$Generador.'.'.$y] = 'nullable|numeric|max:20|min:0';
                    $rules['SolResProfundo.'.$Generador.'.'.$y] = 'nullable|numeric|max:20|min:0';
                    $rules['SolResFotoDescargue_Pesaje.'.$Generador.'.'.$y] = 'nullable|boolean';
                    $rules['SolResFotoTratamiento.'.$Generador.'.'.$y] = 'nullable|boolean';
                    $rules['SolResVideoDescargue_Pesaje.'.$Generador.'.'.$y] = 'nullable|boolean';
                    $rules['SolResVideoTratamiento.'.$Generador.'.'.$y] = 'nullable|boolean';
                }
            }
        }
        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        $attributes = [
            'FK_SolSerPersona' => '"Persona de Contacto"',
            'SolSerTipo'       => '"Tipo de transportador"',
            'SolResAuditoriaTipo' => '"Auditable"',
        ];
        if($this->request->get('SolSerDevolucion') == 'on'){
            $attributes = [
                'SolSerDevolucionTipo' => '"Nombre elementos"',
            ];
        }
        if($this->request->get('SolSerTipo') == 98){
            $attributes = [
                'SolSerTransportador' => '"Transportador"',
                'SolSerConductor'     => '"Conductor"',
                'SolSerVehiculo'      => '"Placa del Vehiculo"',
            ];
            if($this->request->get('SolSerTransportador') == 98){
                $attributes = [
                    'SolSerNameTrans'    => '"Nombre de la transaportadora"',
                    'SolSerNitTrans'     => '"Nit de la transportadora"',
                    'SolSerAdressTrans'  => '"Dirección de la transportadora"',
                    'SolSerCityTrans'    => '"Municipio de la transportadora"',
                    'SolSerConductor'     => '"Conductor"',
                    'SolSerVehiculo'      => '"Placa del Vehiculo"',
                ];
            }
        }
        foreach ($this->request->get('SGenerador') as $Generador => $value) {
            $attributes['SGenerador.'.$Generador] = '"Seleccione el generador (N° '.($Generador+1).')"';
            $attributes['FK_SolResRg.'.$Generador.'.0'] = '"Residuo (N° 1)" del generador (N° '.($Generador+1).')';
            if (isset($this->instance()->all()['FK_SolResRg'][$Generador])) {
                for ($y=0; $y < count($this->instance()->all()['FK_SolResRg'][$Generador]); $y++) {
                    $attributes['FK_SolResRg.'.$Generador.'.'.$y] = '"Residuo (N° '.($y+1).')" del generador (N° '.($Generador+1).')';
                    $attributes['SolResCantiUnidad.'.$Generador.'.'.$y] = '"Cantidad" del residuo (N°'.($y+1).') del generador (N° '.($Generador+1).')';
                    $attributes['SolResKgEnviado.'.$Generador.'.'.$y] = '"Cantidad (Kg)" del residuo (N°'.($y+1).') del generador (N° '.($Generador+1).')';
                    $attributes['SolResEmbalaje.'.$Generador.'.'.$y] = '"Embalaje" del residuo (N°'.($y+1).') del generador (N° '.($Generador+1).')';
                    $attributes['SolResAlto.'.$Generador.'.'.$y] = '"Alto" del residuo (N°'.($y+1).') del generador (N° '.($Generador+1).')';
                    $attributes['SolResAncho.'.$Generador.'.'.$y] = '"Ancho" del residuo (N°'.($y+1).') del generador (N° '.($Generador+1).')';
                    $attributes['SolResProfundo.'.$Generador.'.'.$y] = '"Profundo" del residuo (N°'.($y+1).') del generador (N° '.($Generador+1).')';
                }
            }
        }
        return $attributes;
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [
            'SolSerTipo.numeric' => 'Sorry! Lamer Jajaja',
            'SolResAuditoriaTipo.numeric' => 'Sorry! Lamer Jajaja',
            'SolSerTransportador.numeric' => 'Sorry! Lamer Jajaja',
            'SolResTypeUnidad.numeric' => 'Sorry! Lamer Jajaja',
            'SolResEmbalaje.numeric' => 'Sorry! Lamer Jajaja',
            'between' => 'Sorry! Lamer Jajaja',
            'boolean' => 'Sorry! Lamer Jajaja',
        ];
        return $messages;
    }
}
