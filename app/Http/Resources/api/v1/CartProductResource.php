<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'product_type' => new ProductTypeResource($this->product_types),
            'category' => new CategoryResource($this->product_categories),
            'img' => $this->img,
            'pivot' => $this->pivot,
        ];
    }
}
 