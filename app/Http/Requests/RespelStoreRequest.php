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
            $images = $request['RespelFoto'];

            $rules = [
                // 'RespelFoto' => 'image'
            ];
            foreach($images as $key => $file) {
                $rules['RespelFoto.'.$key] = 'max:1024|mimes:jpeg,png';
            }
            return $rules;
        }

    public function attributes()
    {   
        $request = $this->instance()->all();
        $images = $request['RespelFoto'];
        // return [
        //     'RespelFoto' => 'Fotografía',
        // ];

        $attributes = [];
        // for ($i=0; $i < count($this->request->get('RespelFoto')) ; $i++) { 
            foreach($images as $key => $value)
            {
                $attributes['RespelFoto.'.$key] = '"Fotografía N° '.($key+1).'"';
            }
        // }

        return $attributes;
    }

    public function messages()
    {
        $request = $this->instance()->all();
        $images = $request['RespelFoto'];
        $messages = [
            // 'RespelFoto.required' => 'You must upload a file.'
        ];

        foreach($images as $key => $file) {
            $messages['RespelFoto.'.$key.'.mimes'] = 'el archivo que adjuntó en el campo "Fotografía" del Residuo N° .'.($key+1).' no corresponde con los formatos permitidos: jpg, :values ';
            $messages['RespelFoto.'.$key.'.max'] = 'el archivo que adjuntó en el campo "Fotografía" del Residuo N° .'.($key+1).' excede el máximo permitido de :max Kilobytes';
        }
        return $messages;
    }
    // protected function failedValidation(Validator $validator)
    // {
    //     throw (new ValidationException($validator))
    //                 ->errorBag($this->errorBag)
    //                 ->redirectTo(back());
    // }
}
