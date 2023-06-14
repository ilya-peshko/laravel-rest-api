<?php

namespace App\Repositories\V1\User;

use App\Dto\ApiListingDto;
use App\Dto\User\UserListDto;
use App\Dto\User\UserUpdateDto;
use App\Http\Filters\V1\UserFilter;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

final class UserRepository implements UserRepositoryContract
{
    public function list(UserListDto $dto): ApiListingDto
    {
        $queryParams = $dto->toArray($dto);

        $builder = User::filter(new UserFilter($queryParams));
        $builder->with('address');

        $paginated = $builder->paginate($dto->limit, ['*'], 'page')->withQueryString();

        return new ApiListingDto(
            collection: $paginated->getCollection(),
            lastPage: $paginated->lastPage(),
            total: $paginated->total(),
            count: $paginated->count(),
            nextPageUrl: $paginated->nextPageUrl() ?? null,
            prevPageUrl: $paginated->previousPageUrl() ?? null,
        );
    }

    public function find(int $id): ?Model
    {
        $user = User::findOrFail($id);
        $user->load('invoices');
        $user->load('address');

        return $user;
    }

    public function update(UserUpdateDto $dto): ?Model
    {
        $user = User::findOrFail($dto->id);
        $user->update($dto->toArrayForDataBase($dto));

        return $user;
    }

    public function destroy(int $id): bool
    {
        return User::destroy($id);
    }
}
