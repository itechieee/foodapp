<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    protected $entities = [
        'User',
        'RestaurantUser',
        'CustomerUser',
        'DriverUser'
    ];

    /**
     * Register the service provider.
     */
    public function register()
    {
        foreach ($this->entities as $entity) {
            $this->{'bind'.$entity.'Repository'}();
        }
    }

    protected function bindUserRepository()
    {
        $this->app->bind(
            'App\Repositories\User\UserRepository',
            'App\Repositories\User\EloquentUserRepository'
        );
    }

    protected function bindRestaurantUserRepository()
    {
        $this->app->bind(
            'App\Repositories\API\RestaurantUser\RestaurantUserRepository',
            'App\Repositories\API\RestaurantUser\EloquentRestaurantUserRepository'
        );
    }

    protected function bindCustomerUserRepository()
    {
        $this->app->bind(
            'App\Repositories\API\CustomerUser\CustomerUserRepository',
            'App\Repositories\API\CustomerUser\EloquentCustomerUserRepository'
        );
    }

    protected function bindDriverUserRepository()
    {
        $this->app->bind(
            'App\Repositories\API\DriverUser\DriverUserRepository',
            'App\Repositories\API\DriverUser\EloquentDriverUserRepository'
        );
    }
}
