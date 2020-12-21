<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

// the controller is namespaced unless specifically import the Auth namespace, 
// PHP will assume it's under the namespace of the class, 
// To fix this, add use Auth; at the top of Controller 
use Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        try{
            $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            $credentials = request(['email', 'password']);
            
            // add the remember, in the video is not there
            if(!Auth::attempt($credentials)){
                return response()->json([
                    'status_code' => 422,
                    'message' => 'Unauthorized',
                    ]);
                }
                
                
            $user = User::where('email', $request->email)->first();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
                
                
            if(!Hash::check($request->password, $user->password)){
                return response()->json([
                    'status_code' => 422,
                    'message' => 'Password Match',
                ]);
            }

            
            //dd(Auth::check());
            //dd(Auth::user());

            //return redirect('/');

            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer'
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
