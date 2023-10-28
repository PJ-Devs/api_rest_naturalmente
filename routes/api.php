<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth/google-login', [App\Http\Controllers\api\v1\AuthController::class, 'googleLogin']);

Route::get('/auth/google-callback', []);

Route::apiResource('/v1/users', App\Http\Controllers\api\v1\UserController::class);

//endpoints for products
Route::apiResource('/v1/products', App\Http\Controllers\api\v1\ProductController::class);

//endpoints for categories
Route::apiResource('/v1/categories', App\Http\Controllers\api\v1\ProductCategoryController::class);
Route::get('/v1/products/{id_product}/category', App\Http\Controllers\api\v1\ProductCategoryController::class.'@show');

//endpoints for product types
Route::apiResource('/v1/types', App\Http\Controllers\api\v1\ProductTypeController::class);
Route::get('/v1/products/{id_product}/type', App\Http\Controllers\api\v1\ProductTypeController::class.'@show');
