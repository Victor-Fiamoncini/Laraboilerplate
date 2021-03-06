<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Components
         */
        Blade::component('components.auth-header', 'AuthHeader');
        Blade::component('components.dashboard-header', 'DashboardHeader');
        Blade::component('components.modal', 'Modal');
        Blade::component('components.message', 'Message');
    }
}
