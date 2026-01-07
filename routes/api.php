<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    MyAuthController,
    CategoryController,
    BookController,
    CartController,
    OrderController
};


Route::post('/register', [MyAuthController::class, 'register']);
Route::post('/login', [MyAuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [MyAuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);

    // Books
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::get('/categories/{id}/books', [BookController::class, 'byCategory']);

    // Cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::delete('/cart/item/{id}', [CartController::class, 'remove']);

    // Orders
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
});