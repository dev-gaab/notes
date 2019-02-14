<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return response()->json(['message' => 'Done!']);
        } else {
        	return response()->json(['error' => 'error en login']);
        }
    }

    public function logout(Request $request)
    {
    	Auth::logout();

    	return response()->json(['message' => 'Done!']);
    } 
}
