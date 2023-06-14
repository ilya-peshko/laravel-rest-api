<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder     $builder
     * @param QueryFilter $filter
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter): Builder
    {
        $filter->apply($builder);

        return $builder;
    }
}
