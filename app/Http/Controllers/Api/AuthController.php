<?php

namespace App\Http\Controllers\Api;

use App\User;
use danog\MadelineProto\auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
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

        if ($user) {
            return response([
                'data' => [
                    'login' => $user->login,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'avatar' => $user->avatar,
                    'last_visit' => $user->last_visit,
                    'token' => $this->login($request, true),
                ],
            ], 201);
        } else {
            return response([
                'data' => [
                    'errors' => 'При регистрации произошла ошибка!'
                ]
            ], 400);
        }
    }

    public function login(Request $request, $onlyToken = false)
    {
        $credentials = $request->only('login', 'password');
        if (!$token = JWTAuth::attempt($credentials)) {
            return response([
                'data' => [
                    'errors' => 'Не правильный логин или пароль'
                ],
            ], 422);
        }

        if ($onlyToken) {
            return $token;
        } else {
            $user = auth()->user();
            return response([
                'data' => [
                    'login' => $user->login,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'avatar' => $user->avatar,
                    'last_visit' => $user->last_visit,
                    'token' => $token,
                ],
            ], 200)->header('Authorization', $token);
        }
    }

    public function me()
    {
        $user = auth()->user();

        return response([
                'data' => [
                    'login' => $user->login,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'avatar' => $user->avatar,
                    'last_visit' => $user->last_visit,
                ],
            ], 200);

    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'meta' => [
                'status' => true
            ],
        ], 200);
    }

    public function refresh()
    {
        return response([
            'meta' => [
                'status' => true
            ],
        ], 200);
    }
}
