<?php

namespace App\Repositories\V1;

use App\Contracts\Repositories\CustomerRepositoryContract;
use App\Dto\ApiListingDto;
use App\Dto\Customer\CustomerListDto;
use App\Dto\Customer\CustomerStoreDto;
use App\Dto\Customer\CustomerUpdateDto;
use App\Http\Filters\V1\CustomerFilter;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

final class CustomerRepository implements CustomerRepositoryContract
{
    public function list(CustomerListDto $dto): ApiListingDto
    {
        $queryParams = $dto->toArray($dto);

        $builder   = Customer::filter(new CustomerFilter($queryParams));
        $paginated = $builder->paginate($dto->limit, ['*'], 'page');

        return new ApiListingDto(
            collection: $paginated->getCollection(),
            lastPage: $paginated->lastPage(),
            total: $paginated->total(),
            count: $paginated->count(),
        );
    }

    public function show(int $id): ?Model
    {
        $customers = Customer::findOrFail($id);
        $customers->load('invoices');

        return $customers;
    }

    public function store(CustomerStoreDto $dto): ?Model
    {
        return Customer::create($dto->toArrayForDataBase($dto));
    }

    public function update(CustomerUpdateDto $dto): ?Model
    {
        $model = Customer::findOrFail($dto->id);
        $model->update($dto->toArrayForDataBase($dto));

        return $model;
    }

    public function destroy(int $id): bool
    {
        return Customer::destroy($id);
    }
}
