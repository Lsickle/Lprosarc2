<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function rules(Request $request)
    {
        return [
            'Sede'          => 'required',
            'CargArea'      => 'required',
            'FK_PersCargo'  => 'required_unless:CargArea,NewArea',
            'NewArea'       => 'required_if:CargArea,NewArea|min:4|nullable',
            'NewCargo'      => 'required_if:CargArea,NewArea|required_if:FK_PersCargo,NewCargo|min:4|nullable',

            'PersDocType'   => 'nullable|in:CC,CE,NIT,RUT',
            'PersDocNumber' => 'nullable|max:25|unique:personals,PersDocNumber, ,PersSlug,PersDelete,0',
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
            'PersIngreso'   => 'date',
            'PersSalida'    => 'date|after:PersIngreso|nullable',
            'Persfactura'   => 'max:2|nullable',
            'PersParafiscales'    => 'sometimes|max:1024|mimes:pdf',
			'PersDocOpcional'    => 'sometimes|max:2048|mimes:pdf',
			'PersParafiscalesExpire'    => 'date|after:yesterday|nullable',
        ];
    }

    public function attributes()
    {
        return [
            'NewArea'       => '"¿Cual Area?"',    
            'NewCargo'      => '"¿Cual Cargo?"',
            'FK_PersCargo'  => '"Nombre del cargo"',
        ];
    }
    public function messages()
    {
        return [
            'NewArea.required_if'         => 'El campo :attribute es inválido.',    
            'NewCargo.required_if'        => 'El campo :attribute es inválido.',
            'FK_PersCargo.required_unless'=> 'El campo :attribute es inválido.',
            'PersDocNumber.unique'=> 'El valor del campo :attribute ya se encuentra registrado con otra persona.',
            'PersParafiscalesExpire.after' => 'la fecha de Parafiscales (vencimiento) debe ser a partir del dia de hoy...',
			'PersParafiscales.max' => 'el peso del archivo Parafiscales (PDF) debe ser a menor a :max Mb',
			'PersDocOpcional.max' => 'el peso del archivo Documento Opcional (PDF) debe ser a menor a :max Mb',
			'PersParafiscales.mimes' => 'el tipo del archivo Parafiscales debe ser .pdf',
			'PersDocOpcional.mimes' => 'el tipo del archivo Documento Opcional debe ser .pdf',
        ];
    }
}
