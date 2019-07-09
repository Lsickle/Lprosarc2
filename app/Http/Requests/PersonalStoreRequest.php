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
            'FK_PersCargo'  => 'required',

            'PersDocType'   => 'required|in:CC,CE,NIT,RUT',
            'PersDocNumber' => ['required','max:25',Rule::unique('personals')->where(function($query) use ($request){
                $Personal = DB::table('personals')
                    ->select('PersDocNumber', 'PersDelete')
                    ->where('PersDocNumber', '=', $request->input('PersDocNumber'))
                    ->first();
                if(isset($Personal)){
                    $query->where('PersDocNumber', '=', $Personal->PersDocNumber);
                    $query->where('PersDelete', '=', 0);
                }
                else
                    $query->where('PersDocNumber', '=', null);
            })],
            'PersFirstName' => 'required|max:64',
            'PersSecondName'=> 'max:64|nullable',
            'PersLastName'  => 'required|max:64',
            'PersEmail'     => 'required|email|max:255|regex:/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+[.][a-zA-Z0-9_]{2,6}([.][a-z]{2})?$/i',
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
        ];
    }
}
