<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClienteStoreRequest extends FormRequest
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
        $rule = [
            'CliNit' => ['required','min:13','max:13',Rule::unique('clientes')->where(function ($query) use ($request){
                $Cliente = DB::table('clientes')
                    ->select('clientes.CliNit')
                    ->where('CliNit', $request->input('CliNit'))
                    ->where('CliCategoria', 'Cliente')
                    ->where('CliDelete', 0)
                    ->first();

                if(isset($Cliente->CliNit)){
                    $query->where('clientes.CliNit','=', $Cliente->CliNit);
                }else{
                    $query->where('clientes.CliNit','=', null);
                }
            })],
            'CliName'       => 'required|max:255|min:1',
            'CliShortname'  => 'required|max:255|min:1',
            'CliCategoria'  => 'max:32|alpha|nullable',

            'SedeName'      => 'required|max:128|min:1',
            'SedeAddress'   => 'required|max:255|min:1',
            'SedePhone1'    => 'max:11|min:11|nullable',
            'SedeExt1'      => 'min:2|max:5|nullable',
            'SedePhone2'    => 'max:11|min:11|nullable',
            'SedeExt2'      => 'min:2|max:5|nullable',
            'SedeEmail'     => 'required|email|max:128',
            'SedeCelular'   => 'required|min:12|max:12',
            'FK_SedeMun'    => 'required',

            'AreaName'      => 'required|max:128',

            'CargName'      => 'required|max:128',

            'PersFirstName' => 'required|max:64|min:1',
            'PersLastName'  => 'required|max:64|min:1',
            'PersEmail'     => 'required|email|max:255|unique:personals,PersEmail',
            'PersSecondName'=> 'max:64|nullable',
            'PersDocNumber' => 'required|max:64|min:6|unique:personals,PersDocNumber',
            'PersDocType'   => 'required|in:CC,CE,NIT,RUT',
            'PersCellphone' => 'required|max:12|min:12',
        ];
        return $rule;
    }
    public function messages()
    {
        $request = $this->instance()->all();
        $message = [
        ];
        $messages['PersEmail.unique'] = 'El campo "Correo Electronico de la Persona de Contacto" ya esta en uso ';
        return $messages;
    }
}
