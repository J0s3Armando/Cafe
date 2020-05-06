<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewImageRequest extends FormRequest
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
            'title' => 'max:100',
            'description' => 'max:200',
            'image'=>'required|max:2048|image',
            'type'=>'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'El título es muy largo',
            'type.required'=>'El campo tipo es obligatorio',
            'type.string'=>'Tienes que seleccionar una opción',
            'description.max' => 'La descripción es muy larga',
            'image.required'=>'El campo imágen es obligatorio',
            'image.max'=>'La imágen debe ser menor a 2MB',
            'image.image'=>'Asegúrese que el archivo séa una imágen',
        ];
    }
}
