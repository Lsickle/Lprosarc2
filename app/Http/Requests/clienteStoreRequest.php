<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
    public function rules()
    {   
        if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente')){
            return [
                'CliNit'        => 'required|max:13|min:13|unique:clientes,CliNit',
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

                'AreaName'      => 'required|max:128',

                'CargName'      => 'required|max:128',

                'PersFirstName' => 'required|max:64|min:1',
                'PersLastName'  => 'required|max:64|min:1',
                'PersEmail'     => 'required|email|max:255|unique:personals,PersEmail',
                'PersSecondName'=> 'max:64|nullable',
                'PersDocNumber' => 'required|max:64|min:6|unique:personals,PersDocNumber',
                'PersDocType'   => 'required|max:3|min:2',
                'PersCellphone' => 'required|max:12|min:12',
            ];
        }else{
            return [
                'CliNit'        => 'required|max:13|min:13|unique:clientes,CliNit',
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
            ];
        }
    }
}
