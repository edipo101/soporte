<?php

namespace SIS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TecnicoStoreRequest extends FormRequest
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
            'carnet' => 'required|unique:tecnicos',
            'nombre' => 'required',
            'apellidos' => 'required',
            'cargo' => 'required',
            'titulo' => 'required',
            'nickname' => 'required|unique:users',
            'password' => 'required|min:6',
        ];
    }
}
