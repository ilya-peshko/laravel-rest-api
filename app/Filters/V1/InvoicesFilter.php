<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApiFilter
{
    protected $allowedParams = [
        'customerId' => ['eq'],
        'status'     => ['eq', 'ne'],
        'amount'     => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'billedDate' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'paidDate'   => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];

    protected $operatorMap = [
        'eq'  => '=',
        'gt'  => '>',
        'gte' => '>=',
        'lt'  => '<',
        'lte' => '<=',
        'ne'  => '!=',
    ];

    protected $columnMap = [
        'billedDate' => 'billed_date',
        'paidDate'   => 'paid_date',
        'customerId' => 'customer_id',
    ];
}
