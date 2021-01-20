<?php

namespace SIS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return true
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
            'unidad' => 'required',
            'componente_id' => 'required|integer'
        ];
    }
}
