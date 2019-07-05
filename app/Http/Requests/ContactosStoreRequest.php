<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContactosStoreRequest extends FormRequest
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
            'CliNit' => ['required','min:13','max:13',Rule::unique('clientes')->where(function ($query) use ($request){
                    $Cliente = DB::table('clientes')
                        ->select('clientes.CliNit')
                        ->where('CliNit', $request->input('CliNit'))
                        ->where('CliCategoria', $request->input('CliCategoria'))
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
            'CliCategoria'  => 'required|in:Transportador,Proveedor',

            'SedeName'      => 'required|max:128|min:1',
            'SedeAddress'   => 'required|max:255|min:1',
            'SedePhone1'    => 'max:11|min:11|nullable',
            'SedeExt1'      => 'numeric|min:10|max:99999|nullable',
            'SedePhone2'    => 'max:11|min:11|nullable',
            'SedeExt2'      => 'numeric|min:10|max:99999|nullable',
            'SedeEmail'     => 'required|email|max:128|regex:/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+[.][a-zA-Z0-9_]{2,6}([.][a-z]{2})?$/i',
            'SedeCelular'   => 'required|min:12|max:12',
            'FK_SedeMun'    => 'required|numeric|min:1|max:1122',

            'VehicPlaca'    => 'required_if:CliCategoria,Transportador|max:7|min:7|unique:vehiculos,VehicPlaca|nullable',
            'VehicTipo'     => 'required_if:CliCategoria,Transportador|max:64',
            'VehicCapacidad'=> 'required_if:CliCategoria,Transportador|numeric|max:999999999999999|nullable',
        ];
    }
    public function messages(){
        return [
            'FK_SedeMun.required'=> 'El campo :attribute es obligatorio.',            
            'FK_SedeMun.min'     => 'El campo :attribute es inválido.',            
            'FK_SedeMun.max'     => 'El campo :attribute es inválido.',            
            'FK_SedeMun.numeric' => 'El campo :attribute es inválido.',
            'VehicCapacidad.max' => 'El campo :attribute no debe contener más de 15 caracteres.',
            'SedeExt1.max'       => 'El campo :attribute no debe contener más de 5 caracteres.',
            'SedeExt1.min'       => 'El campo :attribute debe contener al menos 2 caracteres.',
            'SedeExt2.max'       => 'El campo :attribute no debe contener más de 5 caracteres.',
            'SedeExt2.min'       => 'El campo :attribute debe contener al menos 2 caracteres.',
        ];
    }
}
