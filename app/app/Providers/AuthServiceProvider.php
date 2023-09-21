<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\Contracts\AuthRepositoryInterface;
use App\Services\Auth\AuthService;
use App\Services\Auth\Contracts\AuthServiceInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
