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
        //Auth::user()->token()->delete();

        //Auth::logout();

        /*$request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');*/
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
