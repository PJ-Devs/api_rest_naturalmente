<?php

namespace App\Http\Controllers\api\v1;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["data" => ProductCategory::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productCategory = ProductCategory::create($request->all());
        return response()->json(["data" => $productCategory], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_product)
    {
        $id_category = Product::find($id_product)->category;
        $category = ProductCategory::find($id_category);
        return response()->json(["data" => $category], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->all());
        return response()->json(["data" => $productCategory], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return response()->json(null, 204);

    }
}