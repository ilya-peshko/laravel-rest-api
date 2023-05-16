<?php

namespace App\Repositories;

use App\Contracts\Repositories\CustomerRepositoryContract;
use App\Dto\Customer\CustomerListDto;
use App\Dto\Customer\CustomerStoreDto;
use App\Dto\Customer\CustomerUpdateDto;
use App\Http\Filters\V1\CustomerFilter;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class CustomerRepository implements CustomerRepositoryContract
{
    public function list(CustomerListDto $dto): Collection
    {
        $queryParams = $dto->toArray($dto);

        $model = Customer::filter(new CustomerFilter($queryParams));
        $model->paginate($queryParams['limit'], ['*'], 'page', $queryParams['pageNumber']);

        return $model->get();
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
