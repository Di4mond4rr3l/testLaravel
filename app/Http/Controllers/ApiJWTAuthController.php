<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Exception;
use File;
use Illuminate\Http\Request;
use Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class ApiJWTAuthController extends Controller
{
  
    public function login(Request $request)
    {   
        $request->validate([
            'email' => 'bail|required|string|email',
            'password' => 'bail|required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = auth()->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Email or Password',
            ]);
        }
        
        return response()->json([
            'status' => 'success',
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }


    public function show() 
    {
        $user = auth()->user();
        if ($user){
            return $user;
        }

        return response()->json([
            'status' => 'error',
            'error' => 'Invalid token'
        ]);
    }

  
    public function logout(Request $request)
    {
        auth()->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh(Request $request)
    {
        try {
            $newToken = auth()->refresh;
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }

        return response()->json([
            'status' => 'success',
            'authorisation' => [
                'token' => $newToken,
                'type' => 'bearer',
            ]
        ]);
    }
  
}
