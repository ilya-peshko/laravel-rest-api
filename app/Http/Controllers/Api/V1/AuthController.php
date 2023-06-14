<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AuthRequest;
use App\Http\Responses\V1\ApiResponse;
use App\Services\V1\Authorization\AuthorizationServiceContract;

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
