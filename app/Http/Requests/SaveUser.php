<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUser extends FormRequest
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
            'nombre' => ['required','min:3'],
            'rol_id' => ['required'],
            'documento' => ['required','numeric','digits_between:10, 15','unique:users,documento'],
            'telefono' => ['required','numeric','digits_between:7,10'],
            'direccion' => ['required'],
            'email' => ['required','email:rfc,dns','unique:users,email'],
            'contraseña' => ['required','min:8'],
        ];
    }
}
