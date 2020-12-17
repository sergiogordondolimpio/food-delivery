<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Http\Controllers\ProductsController;
use App\Models\Product;
use App\Http\Controllers\Auth\RegisterController;

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

// the first charge website with no previews
Route::get('/addProduct', function () {
    $data = [
        'titlePreview' => 'Card Title',
        'descriptionPreview' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
        'pricePreview' => '$ 1.10',
        'filePreview' => 'storage/docs/food-image1.PNG',
        'reload' => ''
        ];
    return view('/products/addProduct', $data);
});

Route::post('home', [ProductsController::class, 'store']);
Route::post('/addProduct', [ProductsController::class, 'storeOnlyForPreview']);
Route::get('/listProducts', [ProductsController::class, 'list']);
Route::get('/delete/{id}', [ProductsController::class, 'destroy']);
Route::get('/edit/{id}', [ProductsController::class, 'toUpdate']);
Route::post('/update', [ProductsController::class, 'update']);

Route::view('/register', 'auth/registration');
Route::view('/login', 'auth/login');
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/logout', 'App\Http\Controllers\ClientController@logout')->name('logout.api');
    Route::get('/client', 'App\Http\Controllers\ClientController@clientData')->name('client.api');
});
Route::post('/registered', 'App\Http\Controllers\Auth\RegisterController@register')->name('register.api');
Route::post('/logged', 'App\Http\Controllers\Auth\LoginController@login')->name('login.api');