<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Http\Controllers\ProductsController;
use App\Models\Product;

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

Route::get('/', function () {
    return view('home');
});



// routes to the products
Route::middleware('auth')->group(function(){
    // the first charge website with no previews
    Route::get('/addProduct', function () {
        $data = [
            'title' => '',
            'titlePreview' => 'Card Title',
            'descriptionPreview' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
            'pricePreview' => '$ 1.10',
            'filePreview' => 'storage/docs/food-image1.PNG',
            'reload' => ''
            ];
        return view('/products/addProduct', $data);
    });
    
    Route::post('add', [ProductsController::class, 'index']);
    
    //Route::post('add', [ProductsController::class, 'store']);
    //Route::post('/preview', [ProductsController::class, 'storeOnlyForPreview']);
    Route::get('/listProducts', [ProductsController::class, 'list'])->middleware('auth');
    Route::get('/delete/{id}', [ProductsController::class, 'destroy']);
    Route::get('/edit/{id}', [ProductsController::class, 'toUpdate']);
    //Route::post('/update', [ProductsController::class, 'update']);
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

//Route::view('/add', 'products/addProductApi');
// routes of views of the login and register
//route::view('login', 'auth/login');
//Route::view('register', 'auth/registrer');


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
