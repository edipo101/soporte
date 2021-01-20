<?php

namespace SIS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecepcionStoreRequest extends FormRequest
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
            'ticket_id' => 'required',
            'asunto' => 'required',
            'orden_compra' => 'required',
            'empresa' => 'required',
            'caracteristicas' => 'required',
            'observaciones' => 'required',
            // "photo"    => "required|array|min:2",
            // "photo.*"  => "required",
        ];
    }
}
