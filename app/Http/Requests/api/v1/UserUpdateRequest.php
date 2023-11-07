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
            'name'    =>'required|regex:/^[\pL\s]+$/u|max:255|min:7|string',
            'email'   =>'required|max:255|min:7|string|email|unique:users,email',
            'password'=>'required|min:8|max:255|string'
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
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'name.min' => 'The name field must be at least 7 characters long.',

            'email.required' => 'The email field is required.',
            'email.unique' => 'The email address is already in use.',
            'email.alpha_dash' => 'The email field may only contain letters, numbers, dashes, and underscores.',
            'email.min' => 'The email field must be at least 8 characters long.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be a string.',
            'password.min' => 'The password must be at least 8 characters long.',
        ];
    }
}
