<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name'    => 'regex:/^[\pL\s]+$/u|max:255|min:7|string',
            'email'   => 'max:255|min:7|string|email|unique:users,email',
            'password' => 'min:8|max:255|string'
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.string' => 'The name field must be a string.',
            'name.min' => 'The name field must be at least 7 characters long.',
            'name.max' => 'The name field may not be greater than 255 characters.',
            'name.regex' => 'The name field may only contain letters.',

            'email.unique' => 'The email address is already in use.',
            'email.alpha_dash' => 'The email field may only contain letters, numbers, dashes, and underscores.',
            'email.min' => 'The email field must be at least 8 characters long.',
            'email.max' => 'The email field may not be greater than 255 characters.',
            'email.string' => 'The email field must be a string.',

            'password.string' => 'The password field must be a string.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.max' => 'The password may not be greater than 255 characters.',
        ];
    }
}
