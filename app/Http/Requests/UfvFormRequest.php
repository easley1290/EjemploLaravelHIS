<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UfvFormRequest extends FormRequest
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
            'anadir-decripcion'=>'required|min:8',
            'anadir-valor'=>'required|min:6',
            'anadir-fecha'=>'required|min:11',
            'anadir-estado'=>'required'
        ];
    }
}
