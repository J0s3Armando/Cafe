<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeQuantityProductCartRequest extends FormRequest
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
            //
            'quantity'=>'required|integer|min:1|max:99',
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'El campo cantidad es requerido.',
            'quantity.integer' => 'El campo cantidad sólo acepta enteros.',
            'quantity.min' => 'Puedes eliminar el producto si lo deseas.',
            'quantity.max' => 'Solo puedes comprar una cantida limitada de productos.',
        ];
    }
}
