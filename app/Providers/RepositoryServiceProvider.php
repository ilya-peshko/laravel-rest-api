<?php

namespace App\Providers;

use App\Repositories\V1\Address\AddressRepository;
use App\Repositories\V1\Address\AddressRepositoryContract;
use App\Repositories\V1\Registration\RegistrationRepository;
use App\Repositories\V1\Registration\RegistrationRepositoryContract;
use App\Repositories\V1\User\UserRepository;
use App\Repositories\V1\User\UserRepositoryContract;
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
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(AddressRepositoryContract::class, AddressRepository::class);
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
