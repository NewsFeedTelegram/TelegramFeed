<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function me()
    {
        $user = auth()->user();

        return response([
            'data' => [
                'id'=> $user->id,
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
