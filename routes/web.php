<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

    Route::get('/show-userc', [AdminController::class, 'show_user']);

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
Route::get('/', [ProductController::class, 'userpost'])->name('welcome');


// Route::get('/addtocart', function () {
//     return view('addtocart');
// });

Route::get('/cart', function () {
  return view('frontend.cart');
});
Route::get('/signup', function () {
  return view('frontend.signup');
});
Route::get('/shop', function () {
  return view('frontend.shop');
});
// Route::get('/checkout', function () {
//   return view('frontend.checkout');
// });
Route::get('/shopdetails', function () {
  return view('frontend.shopdetails');
});
Route::get('/contact', function () {
  return view('frontend.contact');
});

// Route::get('/cartlist', function () {
//   return view('frontend.cartlist');
// });

//Route::post('/addtocart', [ProductController::class, 'addToCart'])->name('addtocart');

 Route::post('/cart', [ProductController::class, 'addToCart'])->name('addtocart');

//Route::match('/cart', [ProductController::class, 'addToCart'])->name('addtocart');

//Route::match(['get', 'post'], '/cart', [ProductController::class, 'addToCart'])->name('addtocart');


Route::get('/cartlist',[ProductController::class, 'cartList'])->name('clearlist');

Route::delete('/delete-cartlist/{id}', [ProductController::class, 'delete_cartlist'])->name('delete_cartlist');

// Route::get('/cartlist', function () {
//   return view('frontend.cartlist');
// });


Route::post('/submit-form', [ProductController::class, 'storeajx'])->name('storeajax');


// button increment and decrement
Route::post('/cart/increment-new', [ProductController::class, 'incrementQuantity'])->name('cart.increment_new');

Route::post('/cart/decrement-new', [ProductController::class, 'decrementQuantity'])->name('cart.decrement_new');


//  store data into database from session data
Route::post('/store-cart-to-database', [ProductController::class, 'storeSessionCartIntoDatabase'])->name('cart.store.database');

// ordernow
Route::get('/checkout', [ProductController::class, 'ordernow'])->name('ordernow');

Route::any('/orderplace', [ProductController::class, 'orderPlace'])->name('orderplace');

Route::any('/myorder', [ProductController::class, 'myOrder'])->name('myorder');

// session delete cartlist
Route::post('/session-delete', [ProductController::class,'delete_session'])->name('session.delete');


// Route::post('/session-delete', [ProductController::class,'deleteSessionItem'])->name('session.delete');

//Route::get('/removecart/{{id}}', [ProductController::class, 'removeCart'])->name('removecart');

//sesssion increment and decrement session

// Route::post('/cart/increment-session', [ProductController::class, 'incrementSession'])->name('cart.increment.session');

// Route::post('/cart/decrement-session', [ProductController::class, 'decrementSession'])->name('cart.decrement.session');

//For Both Login and Session
Route::post('/cart/increment', [ProductController::class, 'increment'])->name('cart.increment');
Route::post('/cart/decrement', [ProductController::class, 'decrement'])->name('cart.decrement');


// login cartlist increment and decrement
// Route::post('/quantity/increment', [LoginController::class, 'incrementQuantity_l'])->name('quantity.increment_l');
// Route::post('/quantity/decrement', [LoginController::class, 'decrementQuantity_l'])->name('quantity.decrement_l');

// Route::post('/cart/increment', [ProductController::class, 'incrementCart'])->name('cart.increment');





require __DIR__ . '/auth.php';
