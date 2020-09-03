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
                'YRespelClasf4741.*'    => 'sometimes|max:6',
                'ARespelClasf4741.*'    => 'sometimes|max:6',
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
