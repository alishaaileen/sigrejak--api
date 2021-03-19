<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        try {
            if (!$token = Auth::guard('admin')->attempt($credentials)) {
                return response()->json(['message' => 'Invalid email or password'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Cannot create token'], 500);
        }

        return $this->respondWithToken($token);
    }
}
