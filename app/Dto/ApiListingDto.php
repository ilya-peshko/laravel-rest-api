<?php

namespace App\Dto;

use App\Dto\BaseDto;
use Illuminate\Database\Eloquent\Collection;

class ApiListingDto extends BaseDto
{
    public function __construct(
        public readonly Collection $collection,
        public readonly int $lastPage,
        public readonly int $total,
        public readonly int $count,
        public readonly ?string $nextPageUrl,
        public readonly ?string $prevPageUrl,
    ) {
    }
}
