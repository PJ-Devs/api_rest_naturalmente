<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class SellUpdateRequest extends FormRequest
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
            //
            'user_id' => 'exists:users,id',
            'total_price' => 'numeric|min:1',
            'status' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'El id del usuario no existe',

            'total_price.numeric' => 'El precio total debe ser un numero',

            'status.string' => 'El estado debe ser un string',
        ];
    }
}
