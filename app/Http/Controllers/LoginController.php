<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request -> validate([
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);
        if (Auth::attempt($credentials)) {
            return response()-> json(['message' => 'Login successful'],200);
        }
        throw ValidationException::withMessages([
            'password' => ['The provided credentials are incorrect'],
        ]);
    }
    public function logout(){
        Auth::logout();
        return response()->json(['message' => 'Logged out'],200);
    }
}
