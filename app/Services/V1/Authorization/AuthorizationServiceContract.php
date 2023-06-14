<?php

namespace App\Services\V1\Authorization;

use App\Dto\Authorization\AuthDto;

interface AuthorizationServiceContract
{
    public function register(AuthDto $dto): string;

    public function login(AuthDto $dto): string;
}
