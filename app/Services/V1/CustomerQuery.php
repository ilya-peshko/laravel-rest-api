<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery
{
    protected $allowedParams = [
        'postalCode' => ['eq', 'gt', 'lt'],
        'name'       => ['eq'],
        'type'       => ['eq'],
        'email'      => ['eq'],
        'address'    => ['eq'],
        'city'       => ['eq'],
        'state'      => ['eq'],
    ];

    protected $columnMap = [
        'postalCode' => 'postal_code',
    ];

    protected $operatorMap = [
        'eq'  => '=',
        'gt'  => '>',
        'gte' => '>=',
        'lt'  => '<',
        'lte' => '<=',
    ];

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->allowedParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }


        }

        return $eloQuery;
    }
}
