<?php

namespace App\Dto\User;

use App\Dto\BaseDto;

class UserUpdateDto extends BaseDto
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $type,
        public readonly ?string $firstName,
        public readonly ?string $lastName,
        public readonly ?string $email,
    ) {
    }
}
