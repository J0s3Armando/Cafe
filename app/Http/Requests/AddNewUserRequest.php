<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'last_name' => ['required', 'string', 'min:8', 'max:50'],
            'state' => ['required', 'integer', 'not_in:0'],
            'address' => ['required', 'string', 'min:10', 'max:200'],
            'cp' => ['required', 'integer', 'digits:5'],
            'idRole' => ['required', 'integer', 'not_in:0'],
            'phone' => ['required', 'integer', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'El campo nombre muy corto',
            'name.max' => 'El campo nombre es muy largo',
            'last_name.required' => 'El campo apellido es obligatorio',
            'last_name.min' => 'El campo apellido es muy corto',
            'last_name.max' => 'El campo apellido es muy largo',
            'address.required'=>'El campo domicilio es obligatorio',
            'address.min'=>'El campo domicilio es muy corto',
            'address.max'=>'El campo domicilio es muy largo',
            'cp.required' => 'El campo código postal es obligatorio',
            'cp.integer' => 'El campo código postal solo acepta números enteros',
            'cp.digits' => 'El campo código postal debe tener 5 dígitos',
            'idRole.required' => 'El campo tipo de usuario es obligatorio',
            'idRole.integer' => 'El campo tipo de usuario debe existir en la lista',
            'state.required' => 'El campo estado es obligatorio',
            'state.integer' => 'El campo estado debe existir en la lista',
            'phone.required' => 'El campo teléfono es obligatorio',
            'phone.integer' => 'El campo teléfono acepta números enteros',
            'phone.digits' => 'El campo teléfono debe tener 10 dígitos',
            'email.required' => 'El campo correo es obligatorio',
            'email.email' => 'Debes ingresar un correo válido',
            'email.unique' => 'El correo ya está tomado, ingrese otro correo',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo contraseña debe tener mínimo 8 caracteres',
            'password.confirmed'=>'El campo confirmación de contraseña no coincide',
        ];
    }
}
