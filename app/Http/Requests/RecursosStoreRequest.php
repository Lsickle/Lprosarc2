<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecursosStoreRequest extends FormRequest
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
    public function rules()
    {
        $request = $this->instance()->all();
        switch($request["RecCarte"]){
            case 'Foto':
                $rule = [
                    'RecTipo' => 'required|max:32',
                    'RecCarte' => 'required|max:32',
                    'RecSrc.*' => 'mimes:jpg,jpeg,png|max:2048|required',
                ];
                return $rule;
                break;
            case 'Video':
                $rule = [
                    'RecTipo' => 'required|max:32',
                    'RecCarte' => 'required|max:32',
                    'RecSrc.*' => 'mimes:mp4|max:10240|required',
                ];
                return $rule;
                break;
            default:
                abort(500);
            break;
        }
    }
    public function attributes()
    {  
        $request = $this->instance()->all();
        $attributes = [
            'RecSrc.*' => '"Archivo"',
        ];

        if (isset($request['RecSrc'])) {
            $archivos = $request['RecSrc'];
            foreach($archivos as $key => $value){
                $attributes['RecSrc.'.$key] = '"Archivo N° '.($key+1).'"';
            }
        }
        return $attributes;
    }
    public function messages()
    {
        $request = $this->instance()->all();
        $message = [
        ];

        if (isset($request['RecSrc'])) {
            $filemessage = $request['RecSrc'];
            foreach($filemessage as $key => $file) {
                $messages['RecSrc.'.$key.'.mimes'] = 'el archivo que adjuntó en el campo "Archivo" del Residuo N° .'.($key+1).' no corresponde con los formatos permitidos: :values ';
                $messages['RecSrc.'.$key.'.max'] = 'el archivo que adjuntó en el campo "Archivo" del Residuo N° .'.($key+1).' excede el máximo permitido de :max Kilobytes';
            }
        }
        return $messages;
    }
}
