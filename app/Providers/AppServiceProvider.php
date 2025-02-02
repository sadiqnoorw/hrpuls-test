<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\{
        EmployeeRepository, EmployeeRepositoryInterface,
        EmployeeFutureChangeRepository, EmployeeFutureChangeRepositoryInterface
    };

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(EmployeeFutureChangeRepositoryInterface::class, EmployeeFutureChangeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
