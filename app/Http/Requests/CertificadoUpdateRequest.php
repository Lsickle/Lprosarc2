<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Certificado;


class CertificadoUpdateRequest extends FormRequest
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
            'CertNumero' => ['required',Rule::unique('certificados')->where(function ($query) use ($request){
                switch ($request->input('CertType')) {
                    case 0:
                        $certificado = Certificado::where('CertNumero', $request->input('CertNumero'))->first('CertNumero');

                        if(isset($certificado->CertNumero) && $request->input('CertNumeroActual')!=$certificado->CertNumero){
                            $query->where('CertNumero','=', $certificado->CertNumero);
                        }else{
                            $query->where('CertNumero','=', null);
                        }
                        break;
                    case 1:
                        $certificado = Certificado::where('CertManifNumero', $request->input('CertNumero'))->first('CertManifNumero');
                        
                        if(isset($certificado->CertManifNumero) && $request->input('CertNumeroActual')!=$certificado->CertNumero){
                            $query->where('CertNumero','=', $certificado->CertManifNumero);
                        }else{
                            $query->where('CertNumero','=', null);
                        }
                        break;
                    case 2:
                        $certificado = Certificado::where('CertNumero', $request->input('CertNumero'))
                            ->first('CertNumero');
                        break;
                    default:
                        # code...
                        break;
                }
            })],
        ];
    }
     public function messages()
    {
        return [
            'CertNumero.unique' => 'El campo "número de certificado/manifiesto" ya esta en uso.',
        ];
    }
}
