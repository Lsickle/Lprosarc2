<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'NewArea'       => 'max:128|min:4',
            'NewCargo'      => 'max:128|min:4',

            'PersDocType'   => 'required|max:3|min:2',
            'PersDocNumber' => 'required|max:25|unique:personals,PersDocNumber',
            'PersFirstName' => 'required|alpha|max:64',
            'PersSecondName'=> 'alpha|max:64|nullable',
            'PersLastName'  => 'required|alpha|max:64',
            'PersEmail'     => 'required|email|max:255',
            'PersCellphone' => 'required|min:12',
            'PersAddress'   => 'max:255|nullable',

            'PersPhoneNumber' => 'max:20|min:12|nullable',
            'PersEPS'       => 'required|max:255|min:5',
            'PersARL'       => 'required|max:255|min:5',
            'PersLibreta'   => 'max:25',
            'PersPase'      => 'max:25',
            'PersBank'      => 'max:255',
            'PersBankAccaunt' => 'max:64',
            'PersIngreso'   => 'required|date|before:PersSalida',
            'PersSalida'    => 'required|date|after:PersIngreso',
        ];
    }
}
