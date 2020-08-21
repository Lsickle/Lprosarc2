<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;

class GeneradoresStoreRequest extends FormRequest
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
            'GenerNit'      => ['required','min:13','max:13',Rule::unique('generadors')->where(function ($query) use ($request){
                //    Validacion de que un generador puede estar en varios clientes 
                //          pero un cliente no puede repetir de generador
                    $id = userController::IDClienteSegunUsuario();
                    $Sede = DB::table('sedes')
                        ->join('clientes', 'clientes.ID_Cli', '=', 'sedes.FK_SedeCli')
                        ->join('generadors', 'sedes.ID_Sede', 'generadors.FK_GenerCli')
                        ->select('generadors.GenerNit')
                        ->where('ID_Cli', $id)
                        ->where('GenerNit', $request->input('GenerNit'))
                        ->where('GenerDelete', 0)
                        ->first();
    
                    if(isset($Sede->GenerNit)){
                        $query->where('generadors.GenerNit','=', $Sede->GenerNit);
                    }else{
                        $query->where('generadors.GenerNit','=', null);
                    }
                })],

            'GenerName'     => 'required|max:255',
            // 'GenerShortname'=> 'required|max:64',
            'FK_GenerCli'   => 'required', 

            'GSedeAddress'  => 'required|max:255',
            'GSedeCelular'  => 'min:12|max:12|nullable',
            'GSedePhone1'   => 'min:11|max:11|nullable',
            'GSedeExt1'     => 'min:2|numeric|nullable',
            'GSedePhone2'   => 'min:11|max:11|nullable',
            'GSedeExt2'     => 'min:2|numeric|nullable',
            'GSedeName'     => 'required|max:128',
            'GSedeEmail'    => 'required|max:128|email',
            'FK_GSedeMun'   => 'required|numeric|min:1|max:1122',
        ];
    }
}
