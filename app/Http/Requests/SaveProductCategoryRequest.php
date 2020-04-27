<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductCategoryRequest extends FormRequest
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
            'category' => 'required|string|min:3|max:50',
        ];
    }
    /**
     * Get message for each validation error
     * @return array
     */
    public function messages()
    {
        return [
            'category.required' => 'El campo categoría es obligatorio',
            'category.min' => 'La descripción es muy corto',
            'category.max' => 'La descripción es muy largo',
        ];
    }
}
