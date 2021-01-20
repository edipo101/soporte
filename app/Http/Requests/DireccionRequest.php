<?php

namespace SIS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireccionRequest extends FormRequest
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
            'unidad' => 'required|min:3',
            'funcionario' => 'required|min:3',
            'cargo' => 'required|min:3',
            'ipv4'=> 'required|ipv4',
            'mac' => 'required',
        ];
    }
}
