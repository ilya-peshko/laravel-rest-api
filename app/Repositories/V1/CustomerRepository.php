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

        $builder = Customer::filter(new CustomerFilter($queryParams));
        $builder->with('user');

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
        $customer = Customer::findOrFail($id);
        $customer->load('invoices');

        return $customer;
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
