<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use danog\MadelineProto\auth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
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
            'status' => true
        ], 200);
    }

    public function refresh()
    {
        return response([
            'status' => true
        ], 200);
    }
}
