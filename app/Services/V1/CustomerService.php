<?php

namespace App\Services\V1;

use App\Contracts\Repositories\CustomerRepositoryContract;
use App\Contracts\Services\CustomerServiceContract;
use App\Dto\ApiListingDto;
use App\Dto\Customer\CustomerListDto;
use App\Dto\Customer\CustomerStoreDto;
use App\Dto\Customer\CustomerUpdateDto;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class CustomerService implements CustomerServiceContract
{
    public function __construct(
        private readonly CustomerRepositoryContract $customerRepository
    ) {
    }

    public function list(CustomerListDto $dto): ApiListingDto
    {
        return $this->customerRepository->list($dto);
    }

    public function show(int $id): Model
    {
        return $this->customerRepository->find($id);
    }

    public function store(CustomerStoreDto $dto): Model
    {
        return $this->customerRepository->store($dto);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(CustomerUpdateDto $dto): Model
    {
        $user  = Auth::user();
        $model = $this->customerRepository->find($dto->id);

        if (!$user->can('update', $model)) {
            throw new AuthorizationException('No permissions for this action');
        }

        return $this->customerRepository->update($dto);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(int $id): bool
    {
        $user  = Auth::user();
        $model = $this->customerRepository->find($id);

        if (!$user->can('delete', $model)) {
            throw new AuthorizationException('No permissions for this action');
        }

        return $this->customerRepository->destroy($id);
    }
}
