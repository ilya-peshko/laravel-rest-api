<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Services\AuthorizationServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AuthRequest;
use App\Http\Responses\V1\ApiResponse;

class AuthController extends Controller
{
    public function register(AuthRequest $request, AuthorizationServiceContract $authorizationService): ApiResponse
    {
        $token = $authorizationService->register($request->toDto());

        return new ApiResponse([
            'accessToken' => $token,
            'tokenType'   => 'Bearer',
        ]);
    }

    public function login(AuthRequest $request, AuthorizationServiceContract $authorizationService): ApiResponse
    {
        $token = $authorizationService->login($request->toDto());

        return new ApiResponse([
            'accessToken' => $token,
            'tokenType'   => 'Bearer',
        ]);
    }
}
