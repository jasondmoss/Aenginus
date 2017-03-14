<?php

namespace App\Providers;

use App\Aenginus\Cache\NoCache;
use Illuminate\Support\ServiceProvider;
use Aenginus\Cache\Cacheable;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('AenginusCache', function ($app) {
            if (config('cache.enable') == 'true') {
                return new Cacheable();
            } else {
                return new NoCache();
            }
        });
    }
}
