<?php

namespace App\Services\V1\User;

use App\Dto\ApiListingDto;
use App\Dto\User\UserUpdateDto;
use App\Dto\User\UserListDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserServiceContract
{
    public function list(UserListDto $dto): ApiListingDto;

    /**
     * @throws ModelNotFoundException
     */
    public function show(int $id): Model;

    /**
     * @throws ModelNotFoundException
     */
    public function update(UserUpdateDto $dto): Model;

    public function destroy(int $id): void;
}
