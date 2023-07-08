<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    protected $errorBag = 'cliente';

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
            'nombre' => 'required | max:30 | min:2',
            'apellido' => 'required | max:30 | min:2',
            'ci' => 'required | max:9 | min:6',
            'telefono' => 'min:6 | max:12 | nullable'
        ];
    }
}
