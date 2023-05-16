<?php

namespace App\Services;

use App\Contracts\Repositories\CustomerRepositoryContract;
use App\Contracts\Services\CustomerServiceContract;
use App\Dto\Customer\CustomerListDto;
use App\Dto\Customer\CustomerStoreDto;
use App\Dto\Customer\CustomerUpdateDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class CustomerService implements CustomerServiceContract
{
    public function __construct(
        private readonly CustomerRepositoryContract $customerRepository
    ) {
    }

    public function list(CustomerListDto $dto): Collection
    {
        return $this->customerRepository->list($dto);
    }

    public function show(int $id): Model
    {
        return $this->customerRepository->show($id);
    }

    public function store(CustomerStoreDto $dto): Model
    {
        return $this->customerRepository->store($dto);
    }

    public function update(CustomerUpdateDto $dto): Model
    {
        return $this->customerRepository->update($dto);
    }

    public function destroy(int $id): bool
    {
        return $this->customerRepository->destroy($id);
    }
}
