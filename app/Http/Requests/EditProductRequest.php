<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'description' =>'required|min:20|max:35',
            'price'=>'required|min:1|numeric',
            'wholesale_price'=>'nullable|min:1|numeric',
            'quantity_wholesale_price'=>'nullable|min:2|max:99|integer',
            'stock'=>'required|min:1|integer',
            'image'=>'image|max:2048',
            'code'=>'required|string|min:4',
            'long_description'=>'required|string|min:10',
            'id_categories'=>'required|not_in:0',
            'id_units'=>'required|not_in:0',
        ];
    }
    public function messages()
    {
        return [
            'description.required' => 'Debes colocar un nombre al producto',
            'description.max'=>'La description debe ser menor a 35 caracteres',
            'description.min'=>'Este campo debe contar 20 caracteres como mínimo',
            'price.required'=>'Debes colocar un precio',
            'price.numeric'=>'Sólo se acepta números',
            'wholesale_price.min'=>'Sólo números mayores a 1',
            'wholesale_price.numeric'=>'Sólo se aceptan números',
            'quantity_wholesale_price.max'=>'La cantidad es muy grande',
            'quantity_wholesale_price.integer'=>'Sólo se aceptan números enteros',
            'stock.required'=>'Debes colocar la cantidad existente',
            'stock.integer'=>'Sólo números enteros',
            'image.image'=>'Asegúrese que el archivo séa una imágen',
            'image.max'=>'Tamaño máximo de la imágen es 2MB',
            'code.required'=>'Debes ingresar el código interno del producto',
            'code.min'=>'El código debe contar como mínimmo 4 caracteres',
            'long_description.required'=>'Debes ingresar una descripción al producto',
            'long_description.min'=>'La descripción debe contar 10 caracteres como mínimo',
            'id_categories.required'=>'Debes deleccionar una categoría',
            'id_categories.integer'=>'Tienes que seleccionar una opción',
            'id_units.required'=>'Debes deleccionar una unidad',
            'id_units.integer'=>'Tienes que seleccionar una opción',
        ];
    }
}
