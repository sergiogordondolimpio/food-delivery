<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstApi;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// if 404 run:  php artisan optimize 
Route::get('data', [FirstApi::class, 'getData']);
Route::post('add', [ProductsController::class, 'add']);
Route::delete('delete/{id}', [ProductsController::class, 'delete']);
Route::get('search/{title}', [ProductsController::class, 'search']);
Route::post('save', [ProductsController::class, 'testData']);


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Here ist the group of routes that need the authentification with
// sanctum. So that need the token generated in login
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('list', [ProductsController::class, 'listApi']);
    Route::get('logout', [UsersController::class, 'logout']);
    Route::get('user', [UsersController::class, 'user']);
});

// this login generate the token
//Route::post('login', [UsersController::class, 'index']);
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
