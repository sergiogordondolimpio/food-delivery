<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstApi;
use App\Http\Controllers\ProductsController;

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
Route::get('list', [ProductsController::class, 'listApi']);
Route::post('add', [ProductsController::class, 'add']);
Route::delete('delete/{id}', [ProductsController::class, 'delete']);
Route::get('search/{title}', [ProductsController::class, 'search']);
Route::post('save', [ProductsController::class, 'testData']);

