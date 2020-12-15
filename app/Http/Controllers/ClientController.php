<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ClientController extends Controller
{
    //
    public function userData(Request $request){
        return $request->client();
    }

    public function logout(){
        Auth::client()->token()->delete();
    }
}
