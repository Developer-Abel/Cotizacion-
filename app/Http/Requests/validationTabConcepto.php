<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationTabConcepto extends FormRequest
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
            'concepto' => 'required',
            'cantidad' => 'required|integer|min:1',
            'precio_u' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1'
        ];

    }
    function messages(){
        return [
            'concepto.required' => 'Agrege un concepto',

            'cantidad.required' => 'Ingrese la cantidad',
            'cantidad.integer' => 'Ingrese una cantidad valida',
            'cantidad.min' => 'La cantidad debe de ser mayor a 0',

            'precio_u.required' => 'Ingrese el precio unitario',
            'precio_u.regex' => 'Solo se permite 2 decimales',
            'precio_u.numeric' => 'Ingrese un precio valido',
            'precio_u.min' => 'El precio debe de ser mayor a 0'
        ];
    }
}
