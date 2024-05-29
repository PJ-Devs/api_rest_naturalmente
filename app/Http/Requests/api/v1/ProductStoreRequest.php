<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            "description" => "required|string",
            'price'   => 'required|numeric|min:1',
            'category' => 'required|numeric|exists:product_categories,id',
            'product_type' => 'required|numeric|exists:product_types,id',
            'quantity' => 'required|numeric|min:1',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre no puede tener mas de 255 caracteres',
            'name.min' => 'El nombre no puede tener menos de 7 caracteres',
            'name.regex' => 'El nombre solo puede contener letras',

            'description.required' => 'La descripcion es requerida',
            'description.string' => 'La descripcion debe ser un string',

            'price.required' => 'El precio es requerido',
            'price.numeric' => 'El precio debe ser un numero',

            'price.min' => 'El precio debe ser mayor a 0',

            'category.required' => 'La categoria es requerida',
            'category.numeric' => 'La categoria debe ser un numero',
            'category.exists' => 'La categoria no existe',

            'product_type.required' => 'El tipo de producto es requerido',
            'product_type.numeric' => 'El tipo de producto debe ser un numero',
            'product_type.exists' => 'El tipo de producto no existe',

            'quantity.required' => 'La cantidad es requerida',
            'quantity.numeric' => 'La cantidad debe ser un numero',
            'quantity.min' => 'La cantidad debe ser mayor a 0',

            'img.image' => 'La imagen debe ser una imagen',
            'img.mimes' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif, svg',
            'img.max' => 'La imagen no debe pesar mas de 2048 kilobytes'
        ];
    }
}
