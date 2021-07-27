<?php

namespace App\Http\Requests;

// use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;



class RespelStoreRequest extends FormRequest
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
     *max:1024|mimes:jpeg,png
     * @return array
     */

    public function rules()
        {
            $request = $this->instance()->all();

            $rules = [
                'RespelName.*'          => 'required|max:128|string',
                'RespelDescrip.*'       => 'required|max:512|string',
                'RespelIgrosidad.*'     => 'required|max:30|in:No peligroso,Corrosivo,Reactivo,Explosivo,Toxico,Inflamable,Patógeno - Infeccioso,Radiactivo',
                'RespelEstado.*'        => 'required|max:12|string|in:Líquido,Sólido,Gaseoso,SemiSólido',
                'RespelHojaSeguridad.*' => 'sometimes|max:10240|mimes:pdf|required_unless:RespelIgrosidad.*,No peligroso',
                'ARespelClasf4741.*'    => 'nullable|max:6|in:A1010,A1020,A1030,A1040,A1050,A1060,A1070,A1080,A1090,A1100,A1110,A1120,A1130,A1140,A1150,A1160,A1170,A1180,A2010,A2020,A2030,A2040,A2050,A2060,A3010,A3020,A3030,A3040,A3050,A3060,A3070,A3080,A3090,A3100,A3110,A3120,A3130,A3140,A3150,A3160,A3170,A3180,A3190,A3200,A4010,A4020,A4030,A4040,A4050,A4060,A4070,A4080,A4090,A4100,A4110,A4120,A4130,A4140,A4150,A4160',
                'YRespelClasf4741.*'    => 'nullable|max:6|in:Y1,Y2,Y3,Y4,Y5,Y6,Y7,Y8,Y9,Y10,Y11,Y12,Y13,Y14,Y15,Y16,Y17,Y18,Y19,Y20,Y21,Y22,Y23,Y24,Y25,Y26,Y27,Y28,Y29,Y30,Y31,Y32,Y33,Y34,Y35,Y36,Y37,Y38,Y39,Y40,Y41,Y42,Y43,Y44,Y45',
                'RespelTarj.*'          => 'sometimes|max:5120|mimes:pdf',
                'RespelFoto.*'          => 'sometimes|max:5120|mimes:jpg,jpeg,png',
                'RespelDeclaracion.*'   => 'required|max:2',
                'SustanciaControlada.*' => 'required|boolean',
                'SustanciaControladaTipo.*'     => 'sometimes|boolean|nullable',
                'SustanciaControladaNombre.*'   => 'sometimes|max:50|string|nullable',
                'SustanciaControladaDocumento.*'=> 'sometimes|max:2048|mimes:pdf|required_unless:SustanciaControlada.*,0',
            ];

            return $rules;
        }

    public function attributes()
    {
        $request = $this->instance()->all();
        $attributes = [
                'RespelIgrosidad.*'     => 'Peligrosidad',
                'RespelName.*'          => 'Nombre',
                'RespelDescrip.*'       => 'Descripción',
                'RespelEstado.*'        => 'Estado Físico',
                'YRespelClasf4741.*'    => 'Clasificación Y',
                'ARespelClasf4741.*'    => 'Clasificación A',
                'RespelTarj.*'          => 'Tarjeta De Emergencia',
                'SustanciaControlada.*' => '¿Sustancia controlada?',
                'SustanciaControladaTipo.*'     => 'Tipo de sustancia controlada',
                'SustanciaControladaNombre.*'   => 'Nombre de la sustancia',
                'SustanciaControladaDocumento.*'=> 'Certificado de Carencia/Certificado de Registro',
        ];


        if (isset($request['RespelFoto'])) {
            $images = $request['RespelFoto'];
            foreach($images as $key => $value){
                $attributes['RespelFoto.'.$key] = '"Fotografía N° '.($key+1).'"';
            }
        }

        if (isset($request['RespelHojaSeguridad'])) {
            $pdf = $request['RespelHojaSeguridad'];
            foreach($pdf as $key => $value){
                $attributes['RespelHojaSeguridad.'.$key] = '"Hoja de Seguridad N° '.($key+1).'"';
            }
        }

        if (isset($request['RespelTarj'])) {
            $pdf = $request['RespelTarj'];
            foreach($pdf as $key => $value){
                $attributes['RespelTarj.'.$key] = '"Tarjeta De Emergencia N° '.($key+1).'"';
            }
        }

        return $attributes;
    }

    public function messages()
    {
        $request = $this->instance()->all();
        $messages = [
            // 'RespelFoto.required' => 'You must upload a file.'
        ];

        if (isset($request['RespelFoto'])) {
            $imagesmesage = $request['RespelFoto'];
            foreach($imagesmesage as $key => $file) {
                $messages['RespelFoto.'.$key.'.mimes'] = 'el archivo que adjuntó en el campo "Fotografía" del Residuo N° .'.($key+1).' no corresponde con los formatos permitidos: jpg, :values ';
                $messages['RespelFoto.'.$key.'.max'] = 'el archivo que adjuntó en el campo "Fotografía" del Residuo N° .'.($key+1).' excede el máximo permitido de :max Kilobytes';
            }
        }

        return $messages;
    }
}
