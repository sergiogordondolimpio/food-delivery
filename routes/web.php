<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductsController::class, 'listHome']);
//Route::view('/', 'home');



// routes to the products and cart
Route::middleware('auth')->group(function(){
    // Products
    Route::get('/addProduct', [ProductsController::class, 'show'] );
    Route::post('/add', [ProductsController::class, 'index']);
    Route::get('/listProducts', [ProductsController::class, 'list']);
    Route::get('/delete/{id}', [ProductsController::class, 'destroy']);
    Route::get('/edit/{id}', [ProductsController::class, 'toUpdate']);
    Route::post('edit/add', [ProductsController::class, 'index']);

    // Carts
    Route::get('/cart', [CartsController::class, 'show']);
    Route::get('/cart/{id}', [CartsController::class, 'storeItem']);
    Route::get('/cart/delete/{id}', [CartsController::class, 'destroy']);
    Route::post('/checkout', [CartsController::class, 'checkout']);
});


Route::group(['middleware' => ['web']], function() {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    
    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    
    // Confirm Password (added in v6.2)
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
    
    // Email Verification Routes...
    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify'); // v6.x
    /* Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify'); // v5.x */
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
});

   