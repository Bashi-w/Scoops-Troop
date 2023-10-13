<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('home');
});

Route::get('/categories', [App\Http\Controllers\FrontEnd\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [App\Http\Controllers\FrontEnd\CategoryController::class, 'show'])->name('categories.show');
Route::get('/products', [App\Http\Controllers\FrontEnd\ProductController::class, 'index'])->name('products.index');
Route::post('/orders/store', 'App\Http\Controllers\FrontEnd\OrderController@store')->name("orders.store");
Route::post('/home', 'App\Http\Controllers\FrontEnd\MessageController@store')->name("messages.store");

Auth::routes();

Route::delete('/{id}', 'App\Http\Controllers\UserController@destroy')->name("user.destroy");
Route::get('/user/{id}/edit', 'App\Http\Controllers\UserController@edit')->name("user.edit");
Route::put('/user/{id}', 'App\Http\Controllers\UserController@update')->name("user.update");
Route::get('/user/{id}/profile', 'App\Http\Controllers\UserController@index')->name("user.profile");
Route::get('/get-order-items/{orderId}', 'App\Http\Controllers\UserController@getOrderItems');
Route::put('/cancel-order', 'App\Http\Controllers\UserController@cancelOrder')->name('cancel-order');

// cart and checkout
Route::get('/cart/order', 'App\Http\Controllers\FrontEnd\OrderController@orderView')->name("cart.order");
Route::post('/confirm', 'App\Http\Controllers\FrontEnd\OrderController@store')->name('confirm');
Route::post('/checkout', 'App\Http\Controllers\FrontEnd\OrderController@checkout')->name('checkout');
Route::get('/success', 'App\Http\Controllers\FrontEnd\OrderController@success')->name('checkout.success');
Route::get('/cancel', 'App\Http\Controllers\FrontEnd\OrderController@cancel')->name('checkout.cancel');

Route::get('/branches', 'App\Http\Controllers\BranchController@index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('index');
    Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('/products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('/toppings', App\Http\Controllers\Admin\ToppingController::class);
    Route::resource('/orders', App\Http\Controllers\Admin\OrderController::class);
    Route::resource('/customers', App\Http\Controllers\Admin\CustomerController::class);

    Route::get('/addressbook', 'App\Http\Controllers\Admin\CustomerController@addressBook')->name('customers.addressBook');
    Route::get("/search",[App\Http\Controllers\Admin\CustomerController::class,'search']);
    Route::get('users/{id}', 'App\Http\Controllers\Admin\CustomerController@getUserDetails');
    Route::get('/stock', 'App\Http\Controllers\Admin\StockController@index')->name('products.stock');
    Route::post('/stock/add', 'App\Http\Controllers\Admin\StockController@store')->name('addStock');
    Route::post('/stock/edit', 'App\Http\Controllers\Admin\StockController@update')->name('editStock');
    Route::get('/stock/delete/{stockId}', 'App\Http\Controllers\Admin\StockController@destroy')->name('admin.deleteStock');
});



