<?php

namespace App\Providers;

use App\Contracts\Services\AuthorizationServiceContract;
use App\Contracts\Services\CustomerServiceContract;
use App\Services\V1\AuthorizationService;
use App\Services\V1\CustomerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerServiceContract::class, CustomerService::class);
        $this->app->bind(AuthorizationServiceContract::class, AuthorizationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
