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
            'FK_SolSerPersona'  => 'required',
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
                    'SolSerNameTrans'    => 'required',
                    'SolSerNitTrans'     => 'required|max:20',
                    'SolSerAdressTrans'  => 'required|max:255',
                    'SolSerCityTrans'    => ['required',Rule::exists('municipios', 'ID_Mun')],
                    'SolSerConductor'     => 'required|max:255',
                    'SolSerVehiculo'      => 'required|max:9',
                ];
            }
        }
        foreach ($request->input('SGenerador') as $Generador => $value) {
            $rules['SGenerador.'.$Generador] = ['required', Rule::exists('gener_sedes', 'GSedeSlug')->where(function ($query) use ($request ,$Generador){
                $SGeneradors = DB::table('gener_sedes')
                    ->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
                    ->join('clientes', 'generadors.FK_GenerCli', '=', 'clientes.ID_Cli')
                    ->select('generadors.ID_Gener')
                    ->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
                    ->where('gener_sedes.GSedeSlug', $request['SGenerador'][$Generador])
                    ->first();
                if(isset($SGeneradors->ID_Gener)){
                    $query->where('gener_sedes.FK_GSede', $SGeneradors->ID_Gener);
                }
                else{
                    $query->where('gener_sedes.FK_GSede', null);
                }
            })];
            if($request['FK_SolResRg'][$Generador][0]){
                for ($y=0; $y < count($request['FK_SolResRg'][$Generador]); $y++) {
                    $rules['FK_SolResRg.'.$Generador.'.'.$y] = ['required',Rule::exists('residuos_geners', 'SlugSGenerRes')->where(function ($query) use ($request ,$Generador, $y){
                        $RespelGeneradors = DB::table('residuos_geners')
                            ->join('gener_sedes', 'residuos_geners.FK_SGener', '=', 'gener_sedes.ID_GSede')
                            ->join('generadors', 'gener_sedes.FK_GSede', '=', 'generadors.ID_Gener')
                            ->join('clientes', 'generadors.FK_GenerCli', '=', 'clientes.ID_Cli')
                            ->select('gener_sedes.ID_GSede')
                            ->where('clientes.ID_Cli', userController::IDClienteSegunUsuario())
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
                    $rules['SolResEmbalaje.'.$Generador.'.'.$y] = 'required|numeric|between:95,99';
                    $rules['SolResAlto.'.$Generador.'.'.$y] = 'nullable|numeric|max:3';
                    $rules['SolResAncho.'.$Generador.'.'.$y] = 'nullable|numeric|max:3';
                    $rules['SolResProfundo.'.$Generador.'.'.$y] = 'nullable|numeric|max:3';
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [];
        return $messages;
    }
}
