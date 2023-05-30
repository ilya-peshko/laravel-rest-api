<?php

namespace App\Repositories\V1;

use App\Contracts\Repositories\RegistrationRepositoryContract;
use App\Dto\Authorization\AuthDto;
use App\Models\User;

final class RegistrationRepository implements RegistrationRepositoryContract
{
    public function create(AuthDto $dto): User
    {
        return User::create($dto->toArrayForDataBase($dto));
    }
}
