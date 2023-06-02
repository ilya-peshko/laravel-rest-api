<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class CustomerFilter extends QueryFilter
{
    /**
     * @param Builder $builder
     * @param string  $name
     */
    public function name(Builder $builder, string $name)
    {
        $builder->whereRelation('user', 'name', 'like', "%{$name}%");
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
        $builder->whereRelation('user', 'email', 'like', "%{$email}%");
    }

    /**
     * @param Builder $builder
     * @param string  $address
     */
    public function address(Builder $builder, string $address)
    {
        $builder->where('address', 'like', "%{$address}%");
    }

    /**
     * @param Builder $builder
     * @param string  $city
     */
    public function city(Builder $builder, string $city)
    {
        $builder->where('city', 'like', "%$city%");
    }

    /**
     * @param Builder $builder
     * @param string  $type
     */
    public function state(Builder $builder, string $type)
    {
        $builder->where('state', $type);
    }

    /**
     * @param Builder $builder
     * @param string  $type
     */
    public function postalCode(Builder $builder, string $type)
    {
        $builder->where('postalCode', $type);
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
            'name'            => [$this, 'name'],
            'type'            => [$this, 'type'],
            'email'           => [$this, 'email'],
            'address'         => [$this, 'address'],
            'city'            => [$this, 'city'],
            'state'           => [$this, 'state'],
            'postalCode'      => [$this, 'postalCode'],
            'includeInvoices' => [$this, 'includeInvoices'],
        ];
    }
}
