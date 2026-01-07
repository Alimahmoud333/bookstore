<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Livewire\Admin\Dashboard;
/* AUTH */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* USER */
// Route::middleware('auth')->get('/home', function () {
//     return view('user.home');
// });



Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth'])->group(function(){



Route::prefix('user')->group(function () {

    Route::view('/home','user.homepage')->name('user.home');

    Route::view('/categories', 'user.categories')->name('user.categories');

    Route::view('/category/{category}', 'user.category-books')
        ->name('user.category.books');

    Route::view('/books', 'user.books')->name('user.books');

    Route::view('/book/{book}', 'user.book-details')
    ->name('user.book.details');

    Route::view('/cart', 'user.cart')->name('user.cart');

    Route::view('/orders', 'user.orders')->name('user.orders');

});






Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/categories', 'admin.categories')->name('admin.categories');

    Route::view('/books', 'admin.books')->name('admin.books');

    Route::view('/authors', 'admin.authors')->name('admin.authors');

    Route::view('/orders','admin.orders')->name('admin.orders');
});


});