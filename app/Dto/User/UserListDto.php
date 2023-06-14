<?php

namespace App\Dto\User;

use App\Dto\BaseDto;

class UserListDto extends BaseDto
{
    public function __construct(
        public readonly int $limit,
        public readonly ?string $firstName,
        public readonly ?string $lastName,
        public readonly ?string $type,
        public readonly ?string $email,
        public readonly ?string $street,
        public readonly ?string $city,
        public readonly ?string $state,
        public readonly ?string $postalCode,
        public readonly ?bool $includeInvoices,
    ) {
    }
}
