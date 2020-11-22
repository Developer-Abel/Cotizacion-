<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validationTerminoTab extends FormRequest
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
            'termino' => 'required'
        ];
    }
    function messages(){
        return [
            'termino.required'=> 'Ingrese un termino'
        ];
    }
}
