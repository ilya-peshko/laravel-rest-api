<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class AddressFilter extends QueryFilter
{
    /**
     * @param Builder $builder
     * @param string  $street
     */
    public function street(Builder $builder, string $street)
    {
        $builder->where('street', 'like', "%{$street}%");
    }

    /**
     * @param Builder $builder
     * @param string  $city
     */
    public function city(Builder $builder, string $city)
    {
        $builder->where('city', 'like', "%{$city}%");
    }

    /**
     * @param Builder $builder
     * @param string  $state
     */
    public function state(Builder $builder, string $state)
    {
        $builder->where('state', '=', $state);
    }

    /**
     * @param Builder $builder
     * @param string  $postalCode
     */
    public function postalCode(Builder $builder, string $postalCode)
    {
        $builder->where('state', '=', $postalCode);
    }

    /**
     * @return string[]
     */
    protected function filterCallbackMethods(): array
    {
        return [
            'street'     => [$this, 'street'],
            'city'       => [$this, 'city'],
            'state'      => [$this, 'state'],
            'postalCode' => [$this, 'postalCode'],
        ];
    }
}
