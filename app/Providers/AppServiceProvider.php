<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
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
        //
    }

    public static function redirectTo()
    {
        if (auth()->check()) {
            return auth()->user()->role === 'admin' ? '/admin-dashboard' : '/student-dashboard';
        }
        return '/';
    }
    
}
