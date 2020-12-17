<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function register(Request $request){
        try{

            /*$validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:clients',
                'password' => 'required|string|min:8|confirmed',
                'telephone' => 'required|numeric|digits_between:8,12',
            ]);*/
            $validator = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'telephone' => 'required|numeric|digits_between:8,12',
            ]);

            /*if($validator->fails()){
                return response([
                    'error' => $validator->errors()->all()
                ], 422);
            }*/

            $request['password'] = Hash::make($request['password']);
            $request['remember_token'] = Str::random(10);
            $user = User::create($request->toArray());
            //dd($user);
            
            return response()->json([
                'status_code' => 200,
                'message' =>'Registration Successfull',
            ]);

        }catch(Exception $error){

            return response()->json([
                'status_code' => 500,
                'message' =>'Error Registration',
                'error' => $error,
            ]);
        }
    }
}
