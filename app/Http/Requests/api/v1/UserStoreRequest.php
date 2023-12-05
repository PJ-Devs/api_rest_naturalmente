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
            'password' => 'required|min:8|max:255|string'
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
            'email.string' => 'El email debe ser un string',
            'email.email' => 'El email debe ser un email',
            'email.unique' => 'El email ya existe',

            'password.required' => 'La contraseña es requerida',
            'password.max' => 'La contraseña no puede tener mas de 255 caracteres',
            'password.min' => 'La contraseña no puede tener menos de 8 caracteres',
            'password.string' => 'La contraseña debe ser un string',
        ];
    }
}
