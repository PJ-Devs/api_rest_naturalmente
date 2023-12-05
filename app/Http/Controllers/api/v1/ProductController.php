<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\api\v1\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            "data" => ProductResource::collection(Product::all()),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->hasFile('img')) {
            // Saves the product image onto the public storage folder, the storage function returns the path to the file
            $filePath = $request->file('img')->storeAs('public/productImages', time() . '-' . $request->file('img')->getClientOriginalName());
            // Adds the path to the file to the request object
            $request->request->add(['img' => $filePath]);
        }

        dd($request->all());

        $product = Product::create($request->all());

        return response()->json([
            "data" => new ProductResource($product),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            "data" => new ProductResource($product),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        if ($request->hasFile('img')) {
            // Saves the product image onto the public storage folder, the storage function returns the path to the file
            $filePath = $request->file('img')->storeAs('public/productImages', time() . '-' . $request->file('img')->getClientOriginalName());
            // Adds the path to the file to the request object
            $request->request->add(['img' => $filePath]);
        }

        dd($request->all());
        $product->update($request->all());

        return response()->json([
            "data" => new ProductResource($product),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
