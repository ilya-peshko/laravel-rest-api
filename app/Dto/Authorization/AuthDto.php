<?php

namespace App\Dto\Authorization;

use App\Dto\BaseDto;

class AuthDto extends BaseDto
{
    public function __construct(
        public readonly ?string $name,
        public readonly string $email,
        public readonly string $password,
    ) {
    }
}
