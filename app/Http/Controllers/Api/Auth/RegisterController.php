<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);

        $user->profile()->create([]);
        $token = JWTAuth::fromUser($user);

        if ($user) {
            return response()->json([
                'status' => 'true',
            ], 201)->header('Authorization', $token);
        } else {
            return response()->json([
                'errors' => 'При регистрации произошла ошибка!'
            ], 400);
        }
    }

    public function validateLogin(Request $request) {
        $error = (Validator::make($request->all(), [
            'login' => 'required|unique:users'
        ]))->errors();

        if (count($error)) {
            return response()->json([
                'status' => false
            ], 400);
        } else {
            return response()->json([
                'status' => true
            ], 200);
        }
    }
}
