<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\V1\UserService\UserService;
use App\Services\V1\UserService\UserServiceInterface;

class SpringFinanceServiceProvider extends ServiceProvider
{
    public $bindings = [
        UserServiceInterface::class => UserService::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
