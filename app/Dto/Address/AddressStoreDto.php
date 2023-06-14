<?php

namespace App\Dto\Address;

use App\Dto\BaseDto;

class AddressStoreDto extends BaseDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $street,
        public readonly string $city,
        public readonly string $state,
        public readonly string $postalCode,
    ) {
    }
}
