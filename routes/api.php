<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;

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


Route::post('/auth/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'ability:admin'])->group(function(){

    Route::controller(ProductController::class)
			->prefix('products')
			->group(function() {
				Route::get('/all', 'getAllProducts');
                Route::get('/product/{id}', 'getSingleProduct');
				Route::post('/new', 'addNewProduct');
				Route::put('/update/{id}', 'updateProduct');
				Route::delete('/delete/{id}', 'deleteProduct');
			});

	Route::controller(CustomerController::class)
			->prefix('customers')
			->group(function() {
				Route::get('/all', 'getAllCustomers');
                Route::get('/customer/{id}', 'getSingleCustomer');
				Route::post('/new', 'addNewCustomer');
				Route::put('/update/{id}', 'updateCustomer');
				Route::delete('/delete/{id}', 'deleteCustomer');
			});
});


Route::post('testing', function(){
    return 'test api works';
});



// Route::post('/user/create', 'App\Http\Controllers\Auth\RegisterController@create')->name("user.create");

// Route::post('/branch/create', 'App\Http\Controllers\BranchController@create')->name("user.create");


// Route::put('/branch/edit', 'App\Http\Controllers\BranchController@edit')->name("branch.edit");

// Route::delete('/branch/delete', 'App\Http\Controllers\BranchController@destroy')->name("branch.delete");






