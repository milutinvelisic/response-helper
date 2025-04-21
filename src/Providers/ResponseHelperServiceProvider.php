<?php

namespace MilutinVelisic\ResponseHelper\Providers;

use Illuminate\Support\ServiceProvider;
use MilutinVelisic\ResponseHelper\ResponseHelper;

class ResponseHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('response-helper', function () {
            return new ResponseHelper();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Optional: You could publish configuration files, views, etc., here if your package had them.
    }
}