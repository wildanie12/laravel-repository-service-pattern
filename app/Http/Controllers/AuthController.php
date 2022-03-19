<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, true)) {
            $token = $request->user()->createToken('myAppBud', ['manage-members'])->plainTextToken;

            return response()->json(['token' => $token]);
        }

        return back()->withErrors([
            'auth' => 'The provided credentials do not match our records'
        ]);
    }


    public function logout(Request $request)
    {
        $logout = $request->user()->tokens()->delete();
        return response()->json([
            'status' => $logout
        ]);
    }
}
