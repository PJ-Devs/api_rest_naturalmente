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

/**
 * Theese routes are used for authentication by Laravel
 */
Route::middleware('auth')->group(function() {

    /**
     * User routes with auth
     */
    Route::get('/v1/users', [App\Http\Controllers\api\v1\UserController::class, 'index']);
    Route::get('/v1/users/{id}', [App\Http\Controllers\api\v1\UserController::class, 'show']);
    Route::put('/v1/users/{id}', [App\Http\Controllers\api\v1\UserController::class, 'update']);
    Route::delete('/v1/users/{id}', [App\Http\Controllers\api\v1\UserController::class, 'destroy']);
    Route::post('/v1/users{id}/products', [App\Http\Controllers\api\v1\UserController::class.'@attachProduct']);
    Route::delete('/v1/users{user_id}/products/{product_id}', [App\Http\Controllers\api\v1\UserController::class, 'detachProduct']);
    Route::get('/v1/users/{id}/products', [App\Http\Controllers\api\v1\UserController::class, 'getShoppingCart']);

});

/**
 * Theese routes are used for authentication by JWT
 */
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/v1/login', [App\Http\Controllers\api\v1\AuthController::class, 'login']);
    Route::post('/v1/logout', [App\Http\Controllers\api\v1\AuthController::class, 'logout']);
    Route::post('/v1/refresh', [App\Http\Controllers\api\v1\AuthController::class, 'refresh']);
    Route::post('/v1/me', [App\Http\Controllers\api\v1\AuthController::class, 'me']);
});

Route::get('/auth/google-login', [App\Http\Controllers\api\v1\AuthController::class, 'googleLogin']);

Route::get('/auth/google-callback', []);

/**
 * Register routes
 */
Route::post('/v1/register', [App\Http\Controllers\api\v1\AuthController::class.'@register']);

//endpoints for products
Route::apiResource('/v1/products', App\Http\Controllers\api\v1\ProductController::class);

//endpoints for categories
Route::apiResource('/v1/categories', App\Http\Controllers\api\v1\ProductCategoryController::class);
Route::get('/v1/products/{id_product}/category', App\Http\Controllers\api\v1\ProductCategoryController::class.'@show');

//endpoints for product types
Route::apiResource('/v1/types', App\Http\Controllers\api\v1\ProductTypeController::class);
Route::get('/v1/products/{id_product}/type', App\Http\Controllers\api\v1\ProductTypeController::class.'@show');
