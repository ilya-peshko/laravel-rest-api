<?php

namespace App\Contracts\Repositories;

use App\Dto\Authorization\AuthDto;
use App\Models\User;

interface RegistrationRepositoryContract
{
    public function create(AuthDto $dto): User;
}
