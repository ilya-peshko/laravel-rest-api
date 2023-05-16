<?php

namespace App\Providers;

use App\Contracts\Services\CustomerServiceContract;
use App\Services\CustomerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerServiceContract::class, CustomerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
