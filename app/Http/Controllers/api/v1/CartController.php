<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\AttachProductRequest;
use App\Http\Resources\api\v1\CartProductResource;
use App\Http\Requests\api\v1\UpdateProductQuantityRequest;
use App\Models\User;
use App\Models\Product;

class CartController extends Controller
{
    public function attachProduct(string $user_id, AttachProductRequest $request)
    {
        $user = User::find($user_id);
        $targetProduct = Product::find($request->product_id);

        $user->products()->attach([
            $targetProduct->id => [
                'orderedQuantity' => $request->orderedQuantity
            ]
        ]);

        return response()->json([
            'data' => CartProductResource::collection($user->products),
        ], 200);
    }

    public function detachProduct(string $user_id, string $product_id)
    {

        $user = User::find($user_id);
        $targetProduct = Product::find($product_id);
        $user->products()->detach($targetProduct);

        return response()->json([
            'data' => CartProductResource::collection($user->products),
        ], 200);
    }

    public function updateProductQuantity(string $user_id, string $product_id, UpdateProductQuantityRequest $request)
    {
        $user = User::find($user_id);
        $targetProduct = Product::find($product_id);

        $user->products()->updateExistingPivot($targetProduct->id, [
            'orderedQuantity' => $request->orderedQuantity
        ]);

        return response()->json([
            'data' => CartProductResource::collection($user->products),
        ], 200);
    }

    public function getShoppingCart(string $user_id)
    {
        $user = User::find($user_id);

        return response()->json([
            'data' => CartProductResource::collection($user->products),
        ], 200);
    }
}
