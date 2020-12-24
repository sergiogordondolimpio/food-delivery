<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirstApi extends Controller
{
    //
    function getData(){

        return ['name' => 'fran'];
    }
}
