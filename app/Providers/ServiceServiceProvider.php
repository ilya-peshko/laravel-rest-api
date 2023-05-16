<?php

namespace App\Providers;

use App\Contracts\Services\CustomerServiceContract;
use App\Services\CustomerService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        # Internal Services
//        $this->app->bind(CustomerServiceContract::class, CustomerService::class);
    }
}
