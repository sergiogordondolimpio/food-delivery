<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Http\Controllers\ProductsController;

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

$data = [
    'title' => 'Card Title',
    'description' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
    'price' => '$ 1.10',
    'file' => '',
    'titlePreview' => '',
    'descriptionPreview' => '',
    'pricePreview' => '',
    'filePreview' => '',
    ];

Route::get('/', function () {
    return view('home');
});

Route::get('/addProduct', function () {
    $data = [
        'titlePreview' => 'Card Title',
        'descriptionPreview' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
        'pricePreview' => '$ 1.10',
        'filePreview' => 'storage/docs/food-image1.PNG',
        ];
    return view('/products/addProduct', $data);
});

/*
Route::post('/addProduct', function () {

    //dd(Request::file('file')->getClientOriginalName());
    $data = [
        'titlePreview' => '',
        'descriptionPreview' => '',
        'pricePreview' => '',
        'filePreview' => '',
        ];

    $request = Request::all();
    $path = Request::file('file')->getClientOriginalName();
    if ($request['title']){
        //Arr::add($data, 'titlePreview', $data['title']);
        $data['titlePreview'] = $request['title']; 
        $data['title'] = $request['title']; 
        //dd($data); 
    }
    if ($request['description']){
        //Arr::add($data, 'titlePreview', $data['title']);
        $data['descriptionPreview'] = $request['description']; 
        $data['description'] = $request['description']; 
        //dd($data); 
    }
    if ($request['price']){
        //Arr::add($data, 'titlePreview', $data['title']);
        $data['pricePreview'] = "$ {$request['price']}"; 
        //dd($data); 
    }
    if ($request['price']){
        //Arr::add($data, 'titlePreview', $data['title']);
        $data['pricePreview'] = "$ {$request['price']}"; 
        //dd($data); 
    }
    

    return view('/products/addProduct', $data);
    
});
*/

//Route::post('home', [ProductsController::class, 'store']);
Route::post('/addProduct', [ProductsController::class, 'storeOnlyForPreview']);
