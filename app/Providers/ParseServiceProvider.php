<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Parse\ParseClient;

class ParseServiceProvider extends ServiceProvider
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
        $config = $this->app['config']['services.parse'];

        ParseClient::initialize($config['app_id'], $config['rest_key'], $config['master_key']);
    }
}
