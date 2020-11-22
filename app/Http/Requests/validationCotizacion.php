<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationCotizacion extends FormRequest
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
            'nom_cotizacion' => 'required',
            'fecha_ven' => 'required',
            'id_plantilla' => 'required|integer|min:1'
        ];
    }

    function messages(){
        return [
            'nom_cotizacion.required' => 'La cotización requiere de un nombre',
            'fecha_ven.required' => 'Se requiere de una fecha de vencimiento',
            'id_plantilla.required' => 'Selecciona una plantilla',
            'id_plantilla.min' => 'Selecciona una plantilla'
        ];
    }
}
