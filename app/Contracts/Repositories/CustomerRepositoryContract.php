<?php

namespace App\Contracts\Repositories;

use App\Dto\Customer\CustomerListDto;
use App\Dto\Customer\CustomerStoreDto;
use App\Dto\Customer\CustomerUpdateDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface CustomerRepositoryContract
{
    public function list(CustomerListDto $dto): Collection;

    public function show(int $id): ?Model;

    public function store(CustomerStoreDto $dto): ?Model;

    public function update(CustomerUpdateDto $dto): ?Model;

    public function destroy(int $id): bool;

    public function count(): int;
}
