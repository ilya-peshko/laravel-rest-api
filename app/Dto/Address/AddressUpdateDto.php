<?php

namespace App\Dto\Address;

use App\Dto\BaseDto;

class AddressUpdateDto extends BaseDto
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $street,
        public readonly ?string $city,
        public readonly ?string $state,
        public readonly ?string $postalCode,
    ) {
    }
}
