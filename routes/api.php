<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/users/{user}', 'getUserInfo');
});

Route::controller(ProductController::class)->group(function () {
    Route::post('/product', 'create');
    Route::get('/products', 'getProducts');
    Route::get('/products/{product}', 'getProductInfo');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/comment', 'create');
});
