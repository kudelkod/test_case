<?php

namespace App\Providers;

use App\Repositories\Requests\Contracts\RequestRepositoryInterface;
use App\Repositories\Requests\RequestRepository;
use App\Services\Requests\Contracts\RequestServiceInterface;
use App\Services\Requests\RequestService;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
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
}
