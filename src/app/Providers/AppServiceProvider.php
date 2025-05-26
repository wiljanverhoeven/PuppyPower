<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;

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
    public function boot()  : void
    {
        Blade::component('layout.app-layout', \App\View\Components\Layout\AppLayout::class);
        Blade::component('layout.guest-layout', \App\View\Components\Layout\GuestLayout::class);
        Schema::defaultStringLength(191);
    }
}
