<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoUserRequest extends FormRequest
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
            'name'      => 'required|max:255',
            'UsAvatar'  => 'max:255|mimes:jpeg,bmp,svg,png,gif,jpg|nullable',
            'UsRol'     => 'required|max:255',
            'UsRolDesc' => 'max:255|nullable',
            'UsRol2'    => 'required|max:255|nullable',
            'UsRolDesc2'=> 'max:255|nullable',
            'UsType'    => 'max:64|nullable',
            'UsStatus'  => 'max:32|nullable',
        ];
    }
}
