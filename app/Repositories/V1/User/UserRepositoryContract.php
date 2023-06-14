<?php

namespace App\Repositories\V1\User;

use App\Dto\ApiListingDto;
use App\Dto\User\UserListDto;
use App\Dto\User\UserUpdateDto;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryContract
{
    public function list(UserListDto $dto): ApiListingDto;

    public function find(int $id): ?Model;

    public function update(UserUpdateDto $dto): ?Model;

    public function destroy(int $id): bool;
}
