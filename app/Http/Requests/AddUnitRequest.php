<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUnitRequest extends FormRequest
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
            'description'=>'required|string|min:3|max:50',
        ];
    }

    public function messages()
    {
        return [
            'description.required'=>'El campo descripción es obligatorio',
            'description.min'=>'La descripción es muy corto',
            'description.max'=>'La descripción es muy larga',
        ];
    }
}
