<?php

namespace App\Repositories\V1\Address;

use App\Dto\Address\AddressStoreDto;
use App\Dto\ApiListingDto;
use App\Dto\Address\AddressListDto;
use App\Dto\Address\AddressUpdateDto;
use App\Http\Filters\V1\AddressFilter;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

final class AddressRepository implements AddressRepositoryContract
{
    public function list(AddressListDto $dto): ApiListingDto
    {
        $queryParams = $dto->toArray($dto);

        $builder   = Address::filter(new AddressFilter($queryParams));
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

    }

    public function store(AddressStoreDto $dto): ?Model
    {

    }

    public function update(AddressUpdateDto $dto): ?Model
    {

    }

    public function destroy(int $id): bool
    {
        return Address::destroy($id);
    }
}
