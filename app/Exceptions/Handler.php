<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    public function render($request, Exception $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json([
                'error' => 'token_invalid'
            ], 401);
        } elseif ($exception instanceof TokenInvalidException) {
            return response()->json([
                'error' => 'token_invalid'
            ], 401);
        } elseif ($exception instanceof JWTException) {
            return response()->json([
                'error' => 'token_absent'
            ], 401);
        }
        return parent::render($request, $exception);
    }
}
