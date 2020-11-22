<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationConcepto extends FormRequest
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
            'input_concepto' => 'required',
            'input_cantidad' => 'required|integer|min:1',
            'input_precioU' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1'
        ];

    }
    function messages(){
        return [
            'input_concepto.required' => 'Agrege un concepto',

            'input_cantidad.required' => 'Ingrese la cantidad',
            'input_cantidad.integer' => 'Ingrese una cantidad valida',
            'input_cantidad.min' => 'La cantidad debe de ser mayor a 0',

            'input_precioU.required' => 'Ingrese el precio unitario',
            'input_precioU.regex' => 'Solo se permite 2 decimales',
            'input_precioU.numeric' => 'Ingrese un precio valido',
            'input_precioU.min' => 'El precio debe de ser mayor a 0'
        ];
    }
}
