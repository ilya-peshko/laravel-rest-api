<?php

namespace App\Contracts\Filters;

use Illuminate\Database\Eloquent\Builder;

interface QueryFilterContract
{
    public function apply(Builder $builder);
}
