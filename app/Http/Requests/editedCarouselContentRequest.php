<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class editedCarouselContentRequest extends FormRequest
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
            'image'=>'max:2048|image',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'El título es muy largo',
            'description.max' => 'La descripción es muy larga',
            'image.max'=>'La imágen debe ser menor a 2MB',
            'image.image'=>'Asegúrese que el archivo séa una imágen',
        ];
    }
}
