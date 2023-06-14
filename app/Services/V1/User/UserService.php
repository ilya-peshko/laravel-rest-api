<?php

namespace App\Services\V1\User;

use App\Dto\User\UserListDto;
use App\Dto\ApiListingDto;
use App\Dto\User\UserUpdateDto;
use App\Repositories\V1\User\UserRepositoryContract;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class UserService implements UserServiceContract
{
    public function __construct(
        private readonly UserRepositoryContract $userRepository
    ) {
    }

    public function list(UserListDto $dto): ApiListingDto
    {
        return $this->userRepository->list($dto);
    }

    public function show(int $id): Model
    {
        return $this->userRepository->find($id);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UserUpdateDto $dto): Model
    {
        $user  = Auth::user();
        $model = $this->userRepository->find($dto->id);

        if (!$user->can('update', $model)) {
            throw new AuthorizationException('No permissions for this action');
        }

        return $this->userRepository->update($dto);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(int $id): void
    {
        $user  = Auth::user();
        $model = $this->userRepository->find($id);

        if (!$user->can('delete', $model)) {
            throw new AuthorizationException('No permissions for this action');
        }

        $this->userRepository->destroy($id);
    }
}
