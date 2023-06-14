<?php

namespace App\Repositories\V1\Registration;

use App\Dto\Authorization\AuthDto;
use App\Models\User;

interface RegistrationRepositoryContract
{
    public function create(AuthDto $dto): User;
}
