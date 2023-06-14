<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends QueryFilter
{
    /**
     * @param Builder $builder
     * @param string  $firstName
     */
    public function firstName(Builder $builder, string $firstName)
    {
        $builder->where('first_name', 'like', "%{$firstName}%");
    }

    /**
     * @param Builder $builder
     * @param string  $lastName
     */
    public function lastName(Builder $builder, string $lastName)
    {
        $builder->where('last_name', 'like', "%{$lastName}%");
    }


    /**
     * @param Builder $builder
     * @param string  $type
     */
    public function type(Builder $builder, string $type)
    {
        $builder->where('type', $type);
    }

    /**
     * @param Builder $builder
     * @param string  $email
     */
    public function email(Builder $builder, string $email)
    {
        $builder->where('user', 'like', "%{$email}%");
    }

    /**
     * @param Builder $builder
     * @param string  $street
     */
    public function street(Builder $builder, string $street)
    {
        $builder->whereRelation('addresses', 'street', 'like', "%{$street}%");
    }

    /**
     * @param Builder $builder
     * @param string  $city
     */
    public function city(Builder $builder, string $city)
    {
        $builder->whereRelation('addresses', 'city', 'like', "%{$city}%");
    }

    /**
     * @param Builder $builder
     * @param string  $state
     */
    public function state(Builder $builder, string $state)
    {
        $builder->whereRelation('addresses', 'state', '=', $state);
    }

    /**
     * @param Builder $builder
     * @param string  $postalCode
     */
    public function postalCode(Builder $builder, string $postalCode)
    {
        $builder->whereRelation('addresses', 'state', '=', $postalCode);
    }

    /**
     * @param Builder $builder
     * @param bool    $isIncluded
     */
    public function includeInvoices(Builder $builder, bool $isIncluded)
    {
        if ($isIncluded) {
            $builder->with('invoices');
        }
    }

    /**
     * @return string[]
     */
    protected function filterCallbackMethods(): array
    {
        return [
            'firstName'       => [$this, 'firstName'],
            'lastName'        => [$this, 'lastName'],
            'type'            => [$this, 'type'],
            'email'           => [$this, 'email'],
            'street'          => [$this, 'street'],
            'city'            => [$this, 'city'],
            'state'           => [$this, 'state'],
            'postalCode'      => [$this, 'postalCode'],
            'includeInvoices' => [$this, 'includeInvoices'],
        ];
    }
}
