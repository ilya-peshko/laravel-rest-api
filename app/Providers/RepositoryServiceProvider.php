<?php

namespace App\Providers;

use App\Contracts\Repositories\CustomerRepositoryContract;
use App\Repositories\CustomerRepository;
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(CustomerRepositoryContract::class, CustomerRepository::class);
    }
}
