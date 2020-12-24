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
    public function register(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:user',
                'name' => 'required|string|min:6|confirmed',
            ]);

            /*if($validator->fails()){
                return response([
                    'error' => $validator->errors()->all()
                ], 422);
            }*/
            
            $request['password'] = Hash::make($request['password']);
            $request['remember_token'] = Str::random(10);
            // save in the database
            $user = User::create($request->toArray());
            return $user;
            
            return response()->json([
                'status_code' => 200,
                'message' => 'Registration Succesfull'
            ]);

        }catch(Exception $error){
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in registration',
                'error' => $error
            ]);
        }
    }
}
