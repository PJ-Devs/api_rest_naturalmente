<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'    => 'required|regex:/^[\pL\s]+$/u|max:255|min:7|string',
            'email'   => 'required|max:255|min:7|string|email|unique:users,email',
            'password' => 'required|min:8|max:255|string',
            'phone_number' => 'min:4|max:30|string|unique:users,phone_number|alpha_num',
            'address' => 'min:8|max:100|string|regex:/^.*$/u'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no puede tener mas de 255 caracteres',
            'name.min' => 'El nombre no puede tener menos de 7 caracteres',
            'name.regex' => 'El nombre solo puede contener letras',
            'email.required' => 'El email es requerido',
            'email.max' => 'El email no puede tener mas de 255 caracteres',
            'email.min' => 'El email no puede tener menos de 7 caracteres',
            'email.email' => 'El email debe ser valido',
            'email.unique' => 'El email ya esta en uso',
            'password.required' => 'La contraseña es requerida',
            'password.max' => 'La contraseña no puede tener mas de 255 caracteres',
            'password.min' => 'La contraseña no puede tener menos de 8 caracteres',
            'phone_number.max' => 'El numero de telefono no puede tener mas de 30 caracteres',
            'phone_number.min' => 'El numero de telefono no puede tener menos de 4 caracteres',
            'address.max' => 'La direccion no puede tener mas de 255 caracteres',
            'address.min' => 'La direccion no puede tener menos de 8 caracteres',
            'address.regex' => 'La direccion solo puede contener letras, numeros, espacios, guiones y almohadillas',
        ];
    }
}
