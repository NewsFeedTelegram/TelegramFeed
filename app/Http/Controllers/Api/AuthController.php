<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'login' => 'required|string|max:50|unique:user',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'password' => 'required|string|min:6|confirmed',
        ];

        $input = $request->only('login', 'first_name', 'last_name', 'password', 'password_confirmation');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()], 400);
        }

        $login = $request->login;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $password = $request->password;

        $user = User::create([
            'login' => $login,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'avatar' => 'default.png',
            'password' => Hash::make($password)
        ]);

        if ($user) {
            return response([
                'success' => true,
                'data' => $user
            ], 200);
        } else {
            return response([
                'success' => false,
                'data' => []
            ], 200);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        return response([
            'status' => 'success',
            'token' => $token
        ])->header('Authorization', $token);
    }

    public function user()
    {
        return response([
            'status' => 'success',
            'data' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }

    public function validateEmail()
    {
        $this->validate(request(), [
            'email' => 'unique:users'
        ]);
        return [
            'valid' => true
        ];
    }

    public function validateLogin()
    {
        $this->validate(request(), [
            'login' => 'unique:users'
        ]);
        return [
            'valid' => true
        ];
    }
}
