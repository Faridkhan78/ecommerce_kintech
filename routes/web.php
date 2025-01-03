<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin-dashboard', [AdminController::class, 'dashboard']);
    Route::get('/user-side', [UserController::class, 'home']);

    Route::get('/create-user', [AdminController::class, 'create_user']);
    Route::get('/show-user', [AdminController::class, 'show_user']);
    Route::post('/store-user', [AdminController::class, 'stor_user'])->name('store_user');

    Route::get('/delete-user/{id}', [AdminController::class, 'delete_user']);

    Route::get('/edit-user/{id}', [AdminController::class, 'edit_user']);

    Route::post('/update-user/{id}', [AdminController::class, 'update_user']);

    // category routes

    Route::get('/show-category', [AdminController::class, 'show_category']);

    Route::get('/create-category', [AdminController::class, 'create_category']);

    Route::post('/store-category', [AdminController::class, 'store_category']);

    Route::get('/delete-category/{id}', [AdminController::class, 'delete_category']);

    Route::get('/edit-category/{id}', [AdminController::class, 'edit_category']);

    Route::post('/update-category', [AdminController::class, 'update_category']);

    // product routes
     
    Route::get('/show-product', [ProductController::class, 'index']);

  //  Route::get('/show-product', [ProductController::class, 'show_product']);

    Route::get('/create-product', [ProductController::class, 'create']);

    Route::post('/store-product', [ProductController::class, 'store']);

    Route::get('/delete-product/{id}', [ProductController::class, 'delete_product']);

    Route::get('/edit-product/{id}', [ProductController::class, 'edit_product']);

    Route::post('/update-product', [ProductController::class, 'update_product']);

    //user_post

    // Route::get('/', [ProductController::class, 'userpost']);
});
Route::get('/', [ProductController::class, 'userpost']);


Route::get('/addtocart', function () {
    return view('addtocart');
});

// Route::get('/cart', function () {
//   return view('frontend.cart');
// });
Route::get('/checkout', function () {
  return view('frontend.checkout');
});
// Route::get('/cartlist', function () {
//   return view('frontend.cartlist');
// });
//Route::post('/addtocart', [ProductController::class, 'addToCart'])->name('addtocart');
Route::post('/cart', [ProductController::class, 'addToCart'])->name('addtocart');
Route::get('/cartlist', [ProductController::class, 'cartList'])->name('clearlist');


Route::post('/submit-form', [ProductController::class, 'storeajx'])->name('storeajax');

require __DIR__ . '/auth.php';
