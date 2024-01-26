<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if(Auth::guard('cms')->attempt($credentials)) {
            $token = Auth::guard('cms')->user()->createToken('login')->plainTextToken;

            return response(['token' => $token]);

        } else {
            return response(['error' => 'Invalid Login Credentials.'], 401);
        }
    }
}
