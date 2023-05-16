<?php

namespace App\Contracts\Services;

use App\Dto\Customer\CustomerListDto;
use App\Dto\Customer\CustomerStoreDto;
use App\Dto\Customer\CustomerUpdateDto;
//use App\Exceptions\CreateModelException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface CustomerServiceContract
{
    public function list(CustomerListDto $dto): Collection;

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
