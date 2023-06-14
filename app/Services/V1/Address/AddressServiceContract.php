<?php

namespace App\Services\V1\Address;

use App\Dto\ApiListingDto;
use App\Dto\Address\AddressUpdateDto;
use App\Dto\Address\AddressListDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface AddressServiceContract
{
    public function list(AddressListDto $dto): ApiListingDto;

    /**
     * @throws ModelNotFoundException
     */
    public function show(int $id): Model;

    /**
     * @throws ModelNotFoundException
     */
    public function update(AddressUpdateDto $dto): Model;

    public function destroy(int $id): void;
}
