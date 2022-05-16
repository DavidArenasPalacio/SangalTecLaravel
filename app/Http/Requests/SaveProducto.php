<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProducto extends FormRequest
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
            'nombre' => ['required','regex:/^[a-zA-Z\s]+$/u','unique:productos,Nombre_Producto'],
            'precio_compra' => ['required','numeric'],
            'precio_venta' => ['required','numeric'],
            'cantidad' => ['required','numeric'],
        ];
    }
}
