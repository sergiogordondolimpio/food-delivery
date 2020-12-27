<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    //

    public function show(){

        dd('hola');
        return view('cart/cart');
    }
}
