<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehiculoRequest extends FormRequest
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
            'placa' =>  ' alpha_num | unique:vehiculos,placa| min:6 | max:8',
            'tipo' => 'required',
            'marca' => 'nullable',
            'b_sisa' => 'required',
        ];
    }
}
