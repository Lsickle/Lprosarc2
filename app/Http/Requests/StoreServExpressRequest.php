<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\userController;

class StoreServExpressRequest extends FormRequest
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
            'fechadepago' => 'required|date',
            'Referencia' => 'required|max:30',
            'mediodepago' => 'required',
            'montodepago' => 'required|numeric',
            'SolServCantidad' => 'required|numeric',
            'SolServFrecuencia' => 'required|in:semanal,quincenal,mensual,bimensual,trimestral,semestral,anual',
            'SolSerDescript' => 'max:4000',
            'pagoComprobante' => 'required|max:2048|mimes:jpg,jpeg,png,jpe,pdf'
        ];
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
                    $rules['SolResEmbalaje.'.$Generador.'.'.$y] = 'required|numeric|between:86,99';
                    $rules['SolResAlto.'.$Generador.'.'.$y] = 'nullable|numeric|max:30|min:0';
                    $rules['SolResAncho.'.$Generador.'.'.$y] = 'nullable|numeric|max:30|min:0';
                    $rules['SolResProfundo.'.$Generador.'.'.$y] = 'nullable|numeric|max:30|min:0';
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
            'SolResTypeUnidad.numeric' => 'el tipo de unidad no coincide con los permitidos en la aplicación o no esta definido',
            'SolResEmbalaje.numeric' => 'el embalaje no coincide con los permitidos en la aplicación o no esta definido',
            'between' => 'Solo se permiten valores between',
            'boolean' => 'Solo se permiten valores Boolean',
        ];
        return $messages;
    }
}
