<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'nombre_usuario' => ['required','regex:/^[a-zA-Z\s]+$/u','min:3'],
            'documento_usuario' => ['required','numeric','digits_between:6, 12'],
            'telefono_usuario' => ['required','numeric','digits_between:7,10'],
            'direccion_usuario' => ['required'],
            'correo_usuario' => ['required','email:rfc,dns'],
            'contraseña_usuario' => ['required','min:8'],
        ];
    }
}