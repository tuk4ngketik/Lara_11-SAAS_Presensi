<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// add sanctum
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

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
        // add sanctum
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
