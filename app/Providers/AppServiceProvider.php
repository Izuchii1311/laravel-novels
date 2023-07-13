<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        # menggunakan pagination dari bootstrap
        Paginator::useBootstrap();

        # middleware admin
        Gate::define('admin', function(User $user) {
            # karena sudah login maka kita dapat melakukannya langsung
            // return $user->username === "Izuchii";
            return $user->is_admin;
        });
    }
}
