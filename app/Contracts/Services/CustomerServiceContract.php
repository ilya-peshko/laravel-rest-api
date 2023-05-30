<?php

namespace App\Contracts\Services;

use App\Dto\ApiListingDto;
use App\Dto\Customer\CustomerListDto;
use App\Dto\Customer\CustomerStoreDto;
use App\Dto\Customer\CustomerUpdateDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface CustomerServiceContract
{
    public function list(CustomerListDto $dto): ApiListingDto;

    /**
     * @throws ModelNotFoundException
     */
    public function show(int $id): Model;

    public function store(CustomerStoreDto $dto): Model;

    /**
     * @throws ModelNotFoundException
     */
    public function update(CustomerUpdateDto $dto): Model;

    public function destroy(int $id): bool;
}
