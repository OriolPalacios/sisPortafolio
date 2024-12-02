<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('Root', function ($user) {
            return session('current_role') === 'Administrador';
        });

        Gate::define('Administrador', function ($user) {
            return session('current_role') === 'Administrador';
        });

        Gate::define('Docente', function ($user) {
            return session('current_role') === 'Docente';
        });

        Gate::define('Revisor', function ($user) {
            return session('current_role') === 'Revisor';
        });
    }
}
