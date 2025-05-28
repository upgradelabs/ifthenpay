<?php

namespace Upgradelabs\Ifthenpay;

use Illuminate\Support\ServiceProvider;

class IfthenpayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ifthenpay.php' => config_path('ifthenpay.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ifthenpay.php', 'ifthenpay');

        $this->app->singleton('ifthenpay', function ($app) {
            return new Client();
        });
    }
}
