<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolResUpdateRequest extends FormRequest
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
        return [
            'SolResEmbalaje' 		=> 'required|numeric|max:99|min:86',
			'SolResKgEnviado'		=> 'max:999999|required|numeric',
			'SolResTypeUnidad' 		=> 'nullable|in:Unidad,Litros|required_with_all:SolResCantiUnidad',
			'SolResCantiUnidad'		=> 'max:50000|nullable|numeric|required_with_all:SolResTypeUnidad',
			'SolResAlto'			=> 'max:20|nullable|numeric|required_with_all:SolResAncho|required_with_all:SolResProfundo',
			'SolResAncho'			=> 'max:20|nullable|numeric|required_with_all:SolResAlto|required_with_all:SolResProfundo',
			'SolResProfundo'		=> 'max:20|nullable|numeric|required_with_all:SolResAncho|required_with_all:SolResAlto',
			'SolResFotoTratamiento' => 'boolean|nullable',
			'SolResVideoTratamiento'=> 'boolean|nullable',
			'SolResFotoDescargue_Pesaje'  => 'boolean|nullable',
			'SolResVideoDescargue_Pesaje' => 'boolean|nullable',
        ];
    }
    public function messages()
    {
        return [
            'SolResTypeUnidad.in' => 'El campo :attribute es inválido.',
			'SolResEmbalaje.min' => 'El campo :attribute es inválido.',
			'SolResEmbalaje.max' => 'El campo :attribute es inválido.',
			'SolResEmbalaje.numeric' => 'El campo :attribute es inválido.',
			'SolResKgEnviado.max' => 'El campo :attribute es inválido.',
        ];
    }
}
