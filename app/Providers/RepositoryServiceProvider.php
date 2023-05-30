<?php

namespace App\Providers;

use App\Contracts\Repositories\CustomerRepositoryContract;
use App\Contracts\Repositories\RegistrationRepositoryContract;
use App\Repositories\V1\RegistrationRepository;
use App\Repositories\V1\CustomerRepository;
use Illuminate\Support\ServiceProvider;

class  RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepositoryContract::class, CustomerRepository::class);
        $this->app->bind(RegistrationRepositoryContract::class, RegistrationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
