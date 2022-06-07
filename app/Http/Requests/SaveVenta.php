<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveVenta extends FormRequest
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
            'nombreC' => ['required'],
            'producto' => ['required'],
            'cantidad' => ['required','numeric']
            // 'precio' => ['required'],  
            // 'precioTotal' => ['required'] 
        ];
    }
}