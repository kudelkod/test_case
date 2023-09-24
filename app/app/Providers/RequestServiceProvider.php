<?php

namespace App\Providers;

use App\Repositories\Request\Contracts\RequestRepositoryInterface;
use App\Repositories\Request\RequestRepository;
use App\Services\Request\Contracts\RequestServiceInterface;
use App\Services\Request\RequestService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RequestServiceInterface::class, RequestService::class);
        $this->app->bind(RequestRepositoryInterface::class, RequestRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides()
    {
        return [RequestServiceInterface::class, RequestRepositoryInterface::class];
    }
}
