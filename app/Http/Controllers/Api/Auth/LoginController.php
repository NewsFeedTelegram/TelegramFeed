<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'errors' => 'Не правильный логин или пароль'
            ], 400);
        }

        return response()->json([
            'status' => true,
        ], 200)->header('Authorization', $token);
    }

}
