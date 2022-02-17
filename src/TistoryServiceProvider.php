<?php

namespace Miniyus\TistoryApi;

use Closure;
use Illuminate\Support\ServiceProvider;
use Miniyus\TistoryApi\Console\Commands\StartChromeDriver;


class TistoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/api_server.php' => config_path('api_server.php')
        ], 'config');

        $this->publishes([
            __DIR__ . '/config/api_server.php' => config_path('webdriver.php')
        ], 'config');

        $this->commands(StartChromeDriver::class);
    }
}