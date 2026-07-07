<?php

namespace App\Providers;

use App\Services\Auth\RoleBasedRedirectorFactory;
use App\Services\DistanceService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // SINGLETON PATTERN — DistanceService
        // Mendaftarkan DistanceService sebagai singleton di Service Container.
        // Ini memastikan Laravel menggunakan instance yang sama (getInstance())
        // setiap kali DistanceService di-resolve melalui Dependency Injection.
        $this->app->singleton(DistanceService::class, function ($app) {
            return DistanceService::getInstance();
        });

        // FACTORY METHOD PATTERN — DashboardRedirectorFactory
        // Mendaftarkan RoleBasedRedirectorFactory agar bisa di-inject ke AuthController
        $this->app->singleton(RoleBasedRedirectorFactory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
