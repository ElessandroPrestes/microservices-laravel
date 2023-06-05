<?php

namespace App\Providers;

use App\Models\Hero;
use App\Observers\HeroObserver;
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
        Hero::observe(HeroObserver::class);
    }
}
