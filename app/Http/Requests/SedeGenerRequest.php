<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SedeGenerRequest extends FormRequest
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
            'GSedeName' => 'required|max:128',
            'GSedeAddress' => 'required|max:255',
            'GSedePhone1' => 'max:11|min:11|nullable',
            'GSedeExt1' => 'min:2|nullable|numeric',
            'GSedePhone2' => 'max:11|min:11|nullable',
            'GSedeExt2' => 'min:2|nullable|numeric',
            'GSedeEmail' => 'email|required|max:128',
            'GSedeCelular' => 'required|max:12|min:12',
            'FK_GSede' => 'required',
            'FK_GSedeMun' => 'required',
        ];
    }
}
