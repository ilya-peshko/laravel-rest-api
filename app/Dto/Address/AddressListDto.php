<?php

namespace App\Dto\Address;

use App\Dto\BaseDto;

class AddressListDto extends BaseDto
{
    public function __construct(
        public readonly int $limit,
        public readonly ?string $street,
        public readonly ?string $city,
        public readonly ?string $state,
        public readonly ?string $postalCode,
    ) {
    }
}
