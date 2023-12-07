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
Route::middleware('auth:api')->group(function () {

    /**
     * Shopping cart routes
     */
    Route::post(
        '/v1/users/{user_id}/products/{product_id}',
        [App\Http\Controllers\api\v1\CartController::class, 'attachProduct']
    );
    Route::delete(
        '/v1/users/{user_id}/products/{product_id}',
        [App\Http\Controllers\api\v1\CartController::class, 'detachProduct']
    );
    Route::put(
        '/v1/users/{user_id}/products/{product_id}',
        [App\Http\Controllers\api\v1\CartController::class, 'updateProductQuantity']
    );
    Route::get(
        '/v1/users/{id}/products',
        [App\Http\Controllers\api\v1\CartController::class, 'getShoppingCart']
    );


    /**
     * User routes
     */
    Route::put(
        '/v1/users/{id}',
        [App\Http\Controllers\api\v1\UserController::class, 'update']
    );
    Route::delete(
        '/v1/users/{id}',
        [App\Http\Controllers\api\v1\UserController::class, 'destroy']
    );
});

Route::get(
    '/v1/users',
    [App\Http\Controllers\api\v1\UserController::class, 'index']
);
Route::get(
    '/v1/users/{id}',
    [App\Http\Controllers\api\v1\UserController::class, 'show']
);

Route::get(
    '/v1/customers',
    [App\Http\Controllers\api\v1\UserController::class, 'getCustomers']
);

Route::get('/v1/isAdmin', [App\Http\Controllers\api\v1\AuthController::class, 'isAdmin']);

/**
 * Sell routes
 */
Route::apiResource(
    'v1/sells',
    App\Http\Controllers\api\v1\SellController::class
);
Route::post(
    'v1/sells',
    App\Http\Controllers\api\v1\SellController::class . '@store'
);
Route::put(
    'v1/sells/{id_sell}',
    App\Http\Controllers\api\v1\SellController::class . '@update'
);
Route::get(
    'v1/sells/{id_sell}/products/{id_product}',
    App\Http\Controllers\api\v1\SellController::class . '@showProduct'
);
Route::get(
    'v1/products/{id_product}/sells',
    App\Http\Controllers\api\v1\ProductController::class . '@showProductSells'
);
Route::get(
    'v1/sells/{id_sell}/products',
    App\Http\Controllers\api\v1\SellController::class . '@showSellProducts'
);

Route::get(
    'v1/users/{id_user}/sells',
    App\Http\Controllers\api\v1\SellController::class . '@showUserSells'
);

Route::get(
    'v1/users/{id_user}/sells/{id_sell}',
    App\Http\Controllers\api\v1\SellController::class . '@showUserSell'
);

Route::delete(
    'v1/sells/{id_sell}',
    App\Http\Controllers\api\v1\SellController::class . '@destroy'
);

/**
 * Theese routes are used for authentication by JWT
 */
Route::group([
    'middleware' => 'api',
    'prefix' => '/v1/auth'
], function () {
    Route::post(
        '/login',
        [App\Http\Controllers\api\v1\AuthController::class, 'login']
    );
    Route::post(
        '/logout',
        [App\Http\Controllers\api\v1\AuthController::class, 'logout']
    );
    Route::post(
        '/refresh',
        [App\Http\Controllers\api\v1\AuthController::class, 'refresh']
    );
    Route::post(
        '/profile',
        [App\Http\Controllers\api\v1\AuthController::class, 'me']
    );
    Route::post(
        '/register',
        [App\Http\Controllers\api\v1\AuthController::class, 'register']
    );
    Route::post(
        '/check-token-validity',
        [App\Http\Controllers\api\v1\AuthController::class, 'checkTokenValidity']
    );
});

Route::get('/auth/google-login', [App\Http\Controllers\api\v1\AuthController::class, 'googleLogin']);
Route::get('/auth/google-callback', []);

//endpoints for products
Route::apiResource('/v1/products', App\Http\Controllers\api\v1\ProductController::class);

//endpoints for categories
Route::apiResource('/v1/categories', App\Http\Controllers\api\v1\ProductCategoryController::class);
Route::get('/v1/products/{id_product}/category', App\Http\Controllers\api\v1\ProductCategoryController::class . '@show');

//endpoints for product types
Route::apiResource('/v1/types', App\Http\Controllers\api\v1\ProductTypeController::class);
Route::get('/v1/products/{id_product}/type', App\Http\Controllers\api\v1\ProductTypeController::class . '@show');
