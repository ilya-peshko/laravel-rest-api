<?php

namespace App\Repositories\V1\Address;

use App\Dto\Address\AddressStoreDto;
use App\Dto\ApiListingDto;
use App\Dto\Address\AddressListDto;
use App\Dto\Address\AddressUpdateDto;
use Illuminate\Database\Eloquent\Model;

interface AddressRepositoryContract
{
    public function list(AddressListDto $dto): ApiListingDto;

    public function find(int $id): ?Model;

    public function store(AddressStoreDto $dto): ?Model;

    public function update(AddressUpdateDto $dto): ?Model;

    public function destroy(int $id): bool;
}
