<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API customer list request limit
    |--------------------------------------------------------------------------
    | This config contains a limit on the maximum number of clients
    | received from the request API.
    |
    */
    'customer_limit' => env('CUSTOMER_LIMIT', 15),
];
