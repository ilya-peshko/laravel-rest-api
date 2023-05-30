<?php

namespace App\Contracts\Services;

use App\Dto\Authorization\AuthDto;

interface AuthorizationServiceContract
{
    public function register(AuthDto $dto): string;

    public function login(AuthDto $dto): string;
}
