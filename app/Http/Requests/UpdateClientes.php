<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientes extends FormRequest
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
            'nombre' => ['required','regex:/^[a-zA-Z\s]+$/u','min:3'],
            'documento' => ['required','numeric','digits_between:6, 12'],
            'telefono' => ['required','numeric','digits_between:7,10'],
            'direccion' => ['required'] 
        ];
    }
}
