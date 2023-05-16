<?php

namespace App\Dto\Customer;

use App\Dto\BaseDto;

class CustomerUpdateDto extends BaseDto
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $type,
        public readonly ?string $email,
        public readonly ?string $address,
        public readonly ?string $city,
        public readonly ?string $state,
        public readonly ?string $postalCode,
    ) {
    }
}
