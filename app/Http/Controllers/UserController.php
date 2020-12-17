<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //
    public function userData(Request $request){
        return $request->user();
    }

    public function logout(){
        Auth::user()->token()->delete();
    }
}
