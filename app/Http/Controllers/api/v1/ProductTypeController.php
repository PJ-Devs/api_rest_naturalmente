<?php

namespace App\Http\Controllers\api\v1;

use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\api\v1\ProductTypeResource;
use App\Http\Resources\api\v1\ProductResource;
class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "data" => ProductTypeResource::collection(ProductType::all()),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productType = ProductType::create($request->all());
        return response()->json([
            "data" => new ProductTypeResource($productType),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_product)
    {
        $type_id = Product::find($id_product)->product_type;
        $type = ProductType::find($type_id);

        return response()->json([
            "data" => new ProductTypeResource($type),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductType $productType)
    {
        $productType->update($request->all());

        return response()->json([
            "data" => new ProductTypeResource($productType),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();
        return response()->json(null, 204);
    }

    public function getProductsByTypeName(string $type_name)
    {
        $type = ProductType::where('name', $type_name)->first();

        if(!$type) {
            return response()->json([
                "message" => "No se encontro la categoria.",
            ], 404);
        }

        $products = $type->products;

        return response()->json([
            'data' => ProductResource::collection($products),
        ], 200);
    }

}
