<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGestion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'C_CVST' => 'required',
            'C_CVGE' => 'required',
            'C_TELE' => 'required',
            'C_ACCION' => 'required',
            'C_OBSE1' => 'required|min:3|max:250'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'C_CVGE.required' => 'Gestor se necesita',
            'C_CVST.required' => 'Estatus se necesita',
            'C_TELE.required' => 'Tel&eacute;fono se necesita',
            'ACCION.required' => 'Acci&oacute;n se necesita',
            'C_OBSE1.required' => 'Gesti&oacute;n se necesita',
            'C_OBSE1.min' => 'Gesti&oacute;n demasiado corte',
            'C_OBSE1.max' => 'Gesti&oacute;n demasiado larga'
        ];
    }

}
