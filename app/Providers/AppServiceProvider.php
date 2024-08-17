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
        Gate::define('view-user', function ($user) {
            return $user->userRole == 0;
        });

        Gate::define('add-user', function ($user) {
            return $user->userRole == 0;
        });

        Gate::define('edit-user', function ($user) {
            return $user->userRole == 0;
        });

        Gate::define('update-user', function ($user) {
            return $user->userRole == 0;
        });

        Gate::define('delete-user', function ($user) {
            return $user->userRole == 0;
        });

        Gate::define('add-item', function ($user) {
            return in_array($user->userRole, [0,1]); 
        });

        Gate::define('store-item', function ($user) {
            return in_array($user->userRole, [0,1]); 
        });

        Gate::define('edit-item', function ($user) {
            return in_array($user->userRole, [0,1]); 
        });

        Gate::define('edit-item', function ($user) {
            return in_array($user->userRole, [0,1]); 
        });

        Gate::define('delete-item', function ($user) {
            return in_array($user->userRole, [0,1]); 
        });
    }
}
