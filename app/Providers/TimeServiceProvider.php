<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class TimeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->singleton( 'timezone', function ( $app ) {
            return config( 'app.timezone' );
        });
    }
}
