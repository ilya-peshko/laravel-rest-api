<?php

namespace App\Services\V1\Address;

use App\Dto\ApiListingDto;
use App\Dto\Address\AddressListDto;
use App\Dto\Address\AddressUpdateDto;
use App\Repositories\V1\Address\AddressRepositoryContract;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

final class AddressService implements AddressServiceContract
{
    public function __construct(
        private readonly AddressRepositoryContract $addressRepository,
    ) {
    }

    public function list(AddressListDto $dto): ApiListingDto
    {
        return $this->addressRepository->list($dto);
    }

    public function show(int $id): Model
    {
        return $this->addressRepository->find($id);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(AddressUpdateDto $dto): Model
    {
        $user  = Auth::user();
        $model = $this->addressRepository->find($dto->id);

        if (!$user->can('update', $model)) {
            throw new AuthorizationException('No permissions for this action');
        }

        return $this->addressRepository->update($dto);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(int $id): void
    {
        $user  = Auth::user();
        $model = $this->addressRepository->find($id);

        if (!$user->can('delete', $model)) {
            throw new AuthorizationException('No permissions for this action');
        }

        $this->addressRepository->destroy($id);
    }
}
