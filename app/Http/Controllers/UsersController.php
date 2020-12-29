<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Auth;

class UsersController extends Controller
{

    public function userData(Request $request){
        return $request->user();
    }

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Token deleted'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);*/
        

        $user = User::where('email', $request->email)->first();
        
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
                ]);
            }
            
        $token = $user->createToken('my-app-token')->plainTextToken;
            
        $response = [
            'user' => $user,
            'token' => $token
        ];

        /*if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            // The user is being remembered...
        }*/

        //return redirect('/');
        return $response;
    }

}
