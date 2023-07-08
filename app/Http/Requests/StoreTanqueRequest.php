<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTanqueRequest extends FormRequest
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
            'codigo' => 'required | max:30 | min:1',
            'combustible_id' => 'required',
            'estado' => 'required',
            'capacidad' => 'required | gt:0',
            'cantidad_min' => 'required | lte:capacidad',
            'cantidad_disponible' => 'required | lte:capacidad'
        ];
    }

    public function messages()
    {
        return [
            'cantidad_min.lte' => 'La cantidad minima debe ser menor o igual a la capacidad del tanque',
            'cantidad_disponible.lte' => 'La cantidad disponible debe ser menor a la capacidad del tanque',
        ];
    }
}
