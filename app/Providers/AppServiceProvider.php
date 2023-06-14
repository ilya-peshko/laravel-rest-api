<?php

namespace App\Providers;

use App\Services\V1\Address\AddressService;
use App\Services\V1\Address\AddressServiceContract;
use App\Services\V1\Authorization\AuthorizationService;
use App\Services\V1\Authorization\AuthorizationServiceContract;
use App\Services\V1\User\UserService;
use App\Services\V1\User\UserServiceContract;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(AddressServiceContract::class, AddressService::class);
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
