<?php

namespace App\Dto\Customer;

use App\Dto\BaseDto;

class CustomerListDto extends BaseDto
{
    public function __construct(
        public readonly int $limit,
        public readonly int $pageNumber,
        public readonly ?string $name,
        public readonly ?string $type,
        public readonly ?string $email,
        public readonly ?string $address,
        public readonly ?string $city,
        public readonly ?string $state,
        public readonly ?string $postalCode,
        public readonly ?bool $includeInvoices,
    ) {
    }
}
