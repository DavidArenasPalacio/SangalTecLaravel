<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProveedor extends FormRequest
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
            'nombre' => ['required','unique:proveedor,Nombre_Proveedor'],
            'correo' => ['required','email:rfc,dns','unique:proveedor,Correo_Proveedor'],
            'telefono' => ['required','numeric','digits_between:7,10'],
            'direccion' => ['required']
        ];
    }
}
