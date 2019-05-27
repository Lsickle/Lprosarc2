<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class PersonalStoreRequest extends FormRequest
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
            'Sede'          => 'required',
            'CargArea'      => 'required',
            'FK_PersCargo'  => 'required',

            'PersDocType'   => 'required|max:3|min:2',
            'PersFirstName' => 'required|max:64',
            'PersSecondName'=> 'max:64|nullable',
            'PersLastName'  => 'required|max:64',
            'PersEmail'     => 'required|email|max:255',
            'PersCellphone' => 'required|min:12',
            'PersAddress'   => 'max:255|nullable',

            'PersPhoneNumber' => 'max:20||min:10|nullable',
            'PersEPS'       => 'max:255|min:5|nullable',
            'PersARL'       => 'max:255|min:5|nullable',
            'PersLibreta'   => 'max:25',
            'PersPase'      => 'max:25',
            'PersBank'      => 'max:255',
            'PersBankAccaunt' => 'max:64',
            'PersIngreso'   => 'date|before:PersSalida',
            'PersSalida'    => 'date|after:PersIngreso',
        ];
    }
}
